## About Company Stock Application
1) Run following commands for application setup
    - git clone <this repository link> companystock
    - composer install
    - composer dump-autoload
    - php artisan config:clear
    - php artisan cache:clear

2) Run Following commands for Application database setup and seed
    - Update your database configuration as per your environment.Currently I have sent general local environment.
        - DB_HOST=
        - DB_PORT=3306
        - DB_DATABASE=companystock
        - DB_USERNAME=
        - DB_PASSWORD=

3) Update QUEUE_CONNECTION = database .env file for run Queue Jobs in background.

4) Run following command to start server.
    - php artisan serve

5) Run following command to run queue worker in background
    - php /var/www/html/artisan queue:work --sleep=3 --tries=3
   
6) Run following command to run phpunit to check and show result of application's testcases.
    - php artisan test
   
