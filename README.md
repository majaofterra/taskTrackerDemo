## basic task tracker demo

### install

- create DB and user 
- cp .env.example .env
- configure .env with DB details
- composer install 
- npm install 
- npm run dev
- php artisan migrate
- php artisan db:seed
- register new account


### test

For some reason testing wipes the data base so you can will have ro reseed after running each test, I unsure why this is i suspect something is configured wrong

- php artisan test
