

### Clone the code

### Create a Database and connect with your mysql credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=example_username
DB_PASSWORD=example_password
```

## Install Packages and Libraries

```
composer install
npm install
composer run dev/npm run dev
```

## Migrate database
```
php artisan migrate --seed
```

## RUN the command for queue

```
    php artisan queue:work --tries=3
```

## Running the Scheduler

```
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```