# Menu Assigment

## Installation Instructions

Make sure that ports 8890 (Backend), 3307 (MYSQL) are not occupied because docker-compose will use them.

You can set whole application by running this commands in this order

```sh
docker-compose up --build -d

docker-compose exec backend composer install

docker-compose exec backend php artisan migrate:fresh --seed

```
After that you can open http://localhost:8890 in browser
