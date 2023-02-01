# Derak Multi Currency Payment System.

## How to install

1. You need to change public_html folder to public you can find solution about this by searching "How to change public_html to public in cPanel".
2. You have to install composer and npm in last version and also php >= 8.
3. Copy files in home directory and set variables in .env files. These variables will be DB and mail system and domain name.
4. Run these commands in terminal or console.
    ````shell
    composer install
    npm install
    npm run prod
    php artisan migrate:refresh --seed
    ````
5. Our system use internal corn job scheduler then you need to add following job with every minute in your cron jobs or cron tabs.
    ````shell
    * * * * * php /home/derak/artisan schedule:run >> /dev/null 2>&1
    ````
6. Our system use queue processing method which help use load pages faster. First install supervisord base on your OS and after that you need to add these config to supervisord.conf
    ```shell
    [program:laravel-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /home/derak/artisan queue:work --sleep=3 --tries=3 --max-time=3600
    autostart=true
    autorestart=true
    stopasgroup=true
    killasgroup=true
    user=derak
    numprocs=8
    redirect_stderr=true
    stdout_logfile=/home/derak/queue-worker.log
    stopwaitsecs=3600
    ```
7. By default, administrator username is info@derak.info and password is P@ssw0rd321.
8. 
You can follow other documentation to get more information:
1. Database
2. Commands
3. Routes
4. Resources
5. 
