# Laravel Instagram Clone

## Table of Contents

- [Introduction](#introduction)
- [Commands to Run the Project](#commands-to-run-the-project)
- [Notes](#notes)
- [Technologies Used](#technologies-used)
- [Contribution](#contribution)

## Introduction

Welcome to the Laravel Instagram Clone project! This project replicates the core functionality of the popular social media platform, Instagram, using the Laravel framework.

## Commands to Run the Project

To run the project locally, follow these steps:

1. Install Laravel UI:
   ```bash
   composer require laravel/ui
   ```

2. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

3. Dump the Composer autoload:
   ```bash
   composer dump-autoload
   ```

4. Create symbolic links for the storage:
   ```bash
   php artisan storage:link
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Generate an application key:
   ```bash
   php artisan key:generate
   ```

7. Install npm dependencies:
   ```bash
   npm install
   ```

8. Compile assets:
   ```bash
   npm run dev
   ```

9. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

10. Start the queue worker for processing jobs:
    ```bash
    php artisan queue:work
    ```

## Notes

- Add your Mail-Trap Username and Password in the .env file.
- Add your database name in the .env file.

## Technologies Used

- **Laravel:** PHP web application framework
- **Database:** MYSQL
- **Frontend:** Blade templating engine, CSS, JavaScript

## Contributing

- Feel free to contribute to the project by submitting bug reports, feature requests, or code improvements through GitHub
