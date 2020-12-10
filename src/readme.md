# HOWTO RUN

    cd src/
    cp .env.example .env

    docker-compose up -d --build
    docker-compose run --rm composer install
    docker-compose run --rm npm install
    docker-compose artisan key:generate
    docker-compose artisan migrate
    docker-compose artisan storage:link

# Architecture
### -- Models --
***
    User('users')
        id - integer

    Profile('profiles')
        id - integer
        user_id - integer

    Post('posts)
        id - integer

    Comment('comments')
        id - integer
        user_id - integer
        post_id - integer


### -- Relationships --
***
    Save('saves') 
        id - integer
        user_id - integer
        post_id - integer

    FollowsProfile('profile_user')
        id - integer
        user_id - integer
        profile_id - integer

    LikePost('post_user')
        id - integer
        user_id - integer
        post_id - integer

    LikeComment('comment_user')
        id - integer
        user_id - integer
        post_id - integer
