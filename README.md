# KOSA Indonesia — Alumni Management System

A web-based alumni management system developed for **KOSA Indonesia** using Laravel. This application provides a platform for managing alumni data, memberships, events, news, and organizational information.

## About the Project

KOSA Indonesia is a web application designed to support alumni data management, member registration, event participation, and information sharing through a centralized platform.

## Features

- **User Authentication & Authorization** — Role-based access for administrators, alumni, and members.
- **Alumni Management** — Manage alumni profiles and alumni data.
- **Member Registration** — Member registration and email verification.
- **Event Management** — Publish events and manage event registration.
- **News Management** — Publish and display organizational news.
- **Alumni Statistics** — Display alumni data and statistics.
- **Profile Management** — Manage user profile information.
- **Admin Dashboard** — Centralized administration and data management.

## Tech Stack

- **Backend:** PHP, Laravel
- **Frontend:** Blade Templates, HTML, CSS, JavaScript, Bootstrap
- **Database:** MySQL
- **Build Tool:** Vite
- **Version Control:** Git & GitHub

## Requirements

- PHP 8.4 or a compatible version required by the project dependencies
- Composer
- Node.js and npm
- MySQL
- Git

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/ingeyuska/KOSA-INDONESIA.git
   cd KOSA-INDONESIA
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install frontend dependencies:

   ```bash
   npm install
   ```

4. Create the environment file:

   ```bash
   copy .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your database credentials in the `.env` file.

7. Run database migrations:

   ```bash
   php artisan migrate
   ```

8. Build frontend assets:

   ```bash
   npm run build
   ```

9. Start the development server:

   ```bash
   php artisan serve
   ```

10. Open the local URL displayed in the terminal, usually `http://127.0.0.1:8000`.

## Environment Configuration

Configure the following variables in your `.env` file according to your local environment:

```env
APP_NAME="KOSA Indonesia"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alumni
DB_USERNAME=root
DB_PASSWORD=
```

**Important:** Never commit your `.env` file, passwords, API keys, or other sensitive credentials to a public repository.

## Project Status

This project is developed for KOSA Indonesia's alumni and membership management needs.

## Author

**Inge Yuska Anastasya**

GitHub: [@ingeyuska](https://github.com/ingeyuska)
