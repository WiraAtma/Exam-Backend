# Timedoor Backend Programming Exam 2025

Client Scenario: John Doe Bookstore

John Doe, owner of a bookstore, wants to improve customer experience by organizing his book collection based on popularity. This will help suggest the most popular books or authors to customers, making it easier for them to buy or rent.

## Tech Stack

**Server:** Laravel 10, PHP 8.1, MySQL

## Installation

Clone the Repository:

```bash
https://github.com/WiraAtma/Exam-Backend
```

Navigate to Project Directory:

```bash
cd Exam-Backend
```

Install Dependencies:

```bash
composer install
```

Copy Environment File:

```bash
cp .env.example .env
```

Generate Application Key:

```bash
php artisan key:generate
```

Configure Database:

-   Open .env file and set your database connection details.

    ```bash
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    Note: Replace your_database_name, your_database_username, and your_database_password with your actual database name, username, and password.

-   Save the changes to the .env file.

Run Migrations:

```bash
php artisan migrate
```

Seeding dummy/fake data:

-   Author Seeder:
    ```bash
    php artisan db:seed --class=AuthorSeeder
    ```
    Category Seeder:
    ```bash
    php artisan db:seed --class=AuthorSeeder
    ```
    Rating Seeder:
    ```bash
    php artisan db:seed --class=RatingSeeder
    ```
    -
      Recommendation : If You Encounter Issues With Seeding (Memory Errors) RatingSeeder Process, You Can Increase PHP Memory Limit:
      ```bash
      php -d memory_limit=1G artisan db:seed --class=RatingSeeder
      ```
    -
    Book Seeder:
    ⚠️ First make sure the rating has been filled in or there is no failure during the process.
    ```bash
    php artisan db:seed --class=BookSeeder
    ```
    Note : The Book Seeder process will take a few minutes depending on the memory speed.

-   

Serve the project:

```bash
  php artisan serve
```