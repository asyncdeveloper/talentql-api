# Laravel API for TODO app
> A REST API which allows users create todos

## Description
This project was built with Laravel and MySQL.

## Project Features

##### Authentication:
- JWT Auth

##### Project:
- Create/Edit projects
- View/Delete projects

##### Todo:
- Manage todos 
- Attach todo to a project

##### Integration testing :
- PHPUnit (https://phpunit.de)
- Faker (https://github.com/fzaninotto/Faker)

## Running the API
To run the API, you must have:
- **PHP** (https://www.php.net/downloads)
- **MySQL** (https://dev.mysql.com/downloads/installer)

Create an `.env` file using the command. You can use this config or change it for your purposes.

```console
$ cp .env.example .env
```

### Environment
Configure environment variables in `.env` for dev environment based on your MYSQL database configuration

```  
DB_CONNECTION=<YOUR_MYSQL_TYPE>
DB_HOST=<YOUR_MYSQL_HOST>
DB_PORT=<YOUR_MYSQL_PORT>
DB_DATABASE=<YOUR_DB_NAME>
DB_USERNAME=<YOUR_DB_USERNAME>
DB_PASSWORD=<YOUR_DB_PASSWORD>
```

# API documentation
API End points and documentation can be found at:
[Postman Documentation](https://documenter.getpostman.com/view/5928045/TVzNJesH).

### Installation
Install the dependencies and start the server

```console
$ composer install
$ php artisan key:generate
$ php artisan serve
```

You should be able to visit your app at http://localhost:8000

## Testing
To run integration tests:
```console
$ composer test
```
