
## Installation

To get started with the installation, follow these steps:

1. Clone the repository
   `git clone https://github.com/saccsacc/project-jas-task.git`

2. Enter project directory
   `cd project-jas-task`

3. Install/update composer
   `composer install | composer update | composer install --ignore-platform-req=ext-iconv`

4. Install npm
   `npm install`

5. Set up the environment variables
   `cp .env.example .env`

6. Generate an application key
   `php artisan key:generate`

7. Configure the database
   `php artisan migrate`

8. Start the development servers
   `npm run dev` & `php artisan serve`

9. Visit the application at [http://localhost:8000](http://localhost:8000)

## Features

This application includes the following features:

-   User authentication and authorization
-   CRUD operations for Tasks
-   Browser sessions
-   Filter and search to-do lists
-   Pagination
-   Other users cannot update data if the update_at column is not up to date

## Software Recommendations

-   Php Version 8.1.10
-   Laravel Version 10.48.16
-   MySQL
-   NPM 
-   Apache
-   Composer
