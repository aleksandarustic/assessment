# Stock Price Aggregator

## Installation Instructions

Make sure that ports 8890 (Backend), 3307 (MYSQL) are not occupied because docker-compose will use them.

You can set whole application by running this commands in this order

```sh
docker-compose up --build -d

docker-compose exec backend composer install

docker-compose exec backend php artisan migrate:fresh --seed

docker-compose exec backend php artisan app:install
```
Backend url: ``` http://localhost:8890  ```

#### Postman collection is located in root of repository.

## About Application

Initial Tickers will be seeded in applications after installation.
Try not to reach API rate limit of 25 requests per day.

Every minute sync-prices command will be run by scheduler after which latest prices will be saved in cache and DB

Get tickers

```sh
curl --location 'http://localhost:8890/api/tickers'
```

Get single ticker
```sh
curl --location 'http://localhost:8890/api/tickers/1'
```
Get ticker prices

```sh
curl --location 'http://localhost:8890/api/tickers-stock-prices?__relations__[]=ticker'
```

Get real-time tickers prices

```sh
curl --location 'http://localhost:8890/api/tickers-stock-prices/latest'
```

Get report with percentage changes

```sh
curl --location 'http://localhost:8890/api/report'
```

### DB access

**host**: localhost
**username**: xm_user
**password**: password
**port**: 3307
**database**: xm

