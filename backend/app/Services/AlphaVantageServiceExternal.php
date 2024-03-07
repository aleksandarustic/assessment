<?php

namespace App\Services;

use App\DTO\AlphaVantageDtoInterface;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 */
class AlphaVantageServiceExternal implements ExternalStockServiceInterface
{
    /**
     * AlphaVantageServiceExternal constructor.
     * @param string $baseUrl
     * @param string $apiKey
     */
    public function __construct(
        protected string $baseUrl,
        protected string $apiKey
    ) {
    }

    /**
     * @return PendingRequest
     */
    public function getClient(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }


    /**
     * @return PendingRequest
     */
    public function withAuthToken(PendingRequest $client): PendingRequest
    {
        return $client->withQueryParameters(['apikey' => $this->apiKey]);
    }

    /**
     * @param PendingRequest $client
     * @return PendingRequest
     */
    public function withRetryLogic(PendingRequest $client): PendingRequest
    {
        return $client->retry(
            config('services.alpha_vantage.retry_logic.attempts'),
            config('services.alpha_vantage.retry_logic.delay'),
            $this->getRetryMiddleware(),
            false
        );
    }


    /**
     * @param array $calls
     * @return array
     * @throws AuthenticationException
     * @throws AuthorizationException
     * @throws RequestException
     * @throws ValidationException
     */
    public function callAsPool(array $calls): array
    {
        $responses = Http::pool(function (Pool $pool) use ($calls) {
            foreach ($calls as $data) {
                $pool->get($this->baseUrl, $data->toArray() + ['apikey' => $this->apiKey]);
            }
        });

        foreach ($responses as $key => $response) {
            $this->checkResponse($response);

            $responses[$key] = $response->json();
        }

        return $responses;
    }

    /**
     * @throws AuthorizationException
     * @throws RequestException
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function checkResponse(Response $response): void
    {
        if ($response instanceof \Throwable) {
            abort(400, $response->getMessage());
        }

        if ($response->failed()) {
            $this->handleErrors($response);
        }

        if ($response->json('Error Message')) {
            abort(400, $response->json('Error Message'));
        }

        if ($response->json('Information')) {
            abort(400, $response->json('Information'));
        }

    }

    /**
     * @param AlphaVantageDtoInterface $input
     * @return array
     * @throws AuthenticationException
     * @throws AuthorizationException
     * @throws RequestException
     * @throws ValidationException
     */
    public function call(AlphaVantageDtoInterface $input): array
    {
        $client = $this->getClient();
        $client = $this->withAuthToken($client);
        $client = $this->withRetryLogic($client);

        $response = $client->get('/', $input->toArray());

        $this->checkResponse($response);

        return $response->json();
    }

    /**
     * @return callable
     */
    public function getRetryMiddleware(): callable
    {
        return function (Exception $exception, PendingRequest $request) {

            if ($exception instanceof ConnectException || in_array($exception->getCode(),
                    [
                        \Symfony\Component\HttpFoundation\Response::HTTP_TOO_MANY_REQUESTS,
                        \Symfony\Component\HttpFoundation\Response::HTTP_BAD_GATEWAY,
                        \Symfony\Component\HttpFoundation\Response::HTTP_SERVICE_UNAVAILABLE,
                    ])) {

                Log::warning("Retrying request because of Error received from external API: {$exception->getMessage()}");

                return true;
            }

            return false;
        };
    }

    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     * @throws ValidationException|RequestException
     */
    public function handleErrors(Response $response): void
    {
        if ($response->status() == 401) {
            throw new AuthenticationException($response->json()['message'] ?? 'Unauthenticated');
        }

        if ($response->status() == 403) {
            throw new AuthorizationException($response->json()['message']);
        }

        if ($response->status() == 404) {
            throw new NotFoundHttpException($response->json()['message']);
        }

        if ($response->status() == 422) {
            throw ValidationException::withMessages($response->json()['errors']);
        }

        $response->throw();
    }


}
