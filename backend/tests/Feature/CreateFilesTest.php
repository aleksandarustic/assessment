<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use Tests\TestCase;

/**
 * Class CreateFilesTest
 * @package Tests\Feature
 */
class CreateFilesTest extends TestCase
{

    /**
     *
     */
    public function testStoreFile()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response =  $this->post("/files", ['name'=> 'test.pdf', 'type'=> 'file','parent_id' => '']);

        $response->assertRedirect();

        $this->assertDatabaseHas('files', ['name' => 'test.pdf', 'type' => 'file']);
    }


}
