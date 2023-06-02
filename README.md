# Counter App application
Hotel App is a very simple web application to manage room checkins in a hotel. It is created only for education purposes. 
Technologies that have been used are Symfony 5, Bootstrap 5.3, MariaDB 10, HTML 5 and CSS. 
For this time Hotel App has basic features, but it is going to be developed in the near future.

## How to use it
Is recommended use Docker to try this app.
1. Install Docker, run Docker Desktop
2. Download this repository and unzip it
3. Open app folder in terminal
4. Build image in Docker by command: <code>docker-compose build</code> and then <code>docker-compose up -d</code>
5. Open app container by command: <code>docker exec -it hotel-main_fpm_1 bash</code>. Name 'hotel-main_fpm_1' may be different according what Docker named the container. 
6. Install vendors: <code>composer install</code>
7. Make database migrations: <code>php bin/console doctrine:migrations:migrate --no-interaction</code>
9. Open localhost:10302 in your webbrowser

