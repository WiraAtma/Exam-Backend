# Timedoor Backend Programming Exam 2025

Client Scenario: John Doe Bookstore

John Doe, our client, owns a bookstore business. His primary revenue streams come from renting or selling books. To enhance customer experience, he wants to recap his entire book collection and sort it based on popularity. The goal is to provide customers with suggestions for the most popular books or authors, making their book-buying or borrowing experience more enjoyable.

## Tech Stack

**Client:** Bootstrap v5.3

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

```bash
php artisan db:seed --class=AuthorSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=RatingSeeder
php artisan db:seed --class=BookSeeder
```

⚠️ If You Encounter Issues With Seeding Process (Memory Errors / Slow Performance)
You can increase the PHP memory limit using this command:
```bash
php -d memory_limit=1G artisan db:seed --class=RatingSeeder
php -d memory_limit=1G artisan db:seed --class=BookSeeder
```

Serve the project:

```bash
  php artisan serve
```