## Requirements

* PHP 8.2 or above
* MySQL 8 or above
* Composer

## How to run the project

Duplicate the ".env.example" file and rename it to ".env".
Change the database credentials in the .env file

Install PHP dependencies
```
composer install
```
Generate the key in the .env file
```
php artisan key:generate
```

## Commands to create the project
Creating the laravel project
```
composer create-project laravel/laravel .
```

Change the database credentials in the .env file

Creating the API routes file
```
php artisan install:api
```

