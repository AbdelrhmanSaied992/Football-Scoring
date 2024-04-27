Football-Scoring
Welcome to Football-Scoring! This project is built with Laravel and provides features for managing football matches, live scoring, leaderboards, and more.

Installation
1. Clone the Repository

Clone this repository to your local machine.

2. Install Dependencies

composer install

3. Configure Environment Variables
Create a copy of the .env.example file

cp .env.example .env

4. Create database and add it to .env file

5. Generate App Key
Generate an application key using the artisan key:generate Artisan command:

php artisan key:generate

5. Run Migrations
Run database migrations to create the necessary tables:

php artisan migrate

6. Seed Database 

php artisan db:seed

7. Install Passport Keys 


php artisan passport:install

8. Start the Development Server
You can start the development server using the serve Artisan command:


php artisan serve
