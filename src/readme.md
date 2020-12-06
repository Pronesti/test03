# HOWTO RUN

    cd src/
    cp .env.example .env

    docker-compose up -d --build
    docker-compose run --rm composer install
    docker-compose run --rm npm install
    docker-compose artisan key:generate
    docker-compose artisan migrate
    docker-compose artisan storage:link