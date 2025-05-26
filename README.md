## 📬 Password Reset and Email Delivery
The reset email might be cought in your spam or bin. Make sure you check them.


# Newsletter Management SaaS Application

A Laravel-based Software-as-a-Service (SaaS) application for managing newsletters, subscriptions, and user accounts. This project demonstrates role-based access control, relationship management, and Laravel best practices.

## Features

- **User Authentication**: Complete authentication system with registration and login
- **Role-Based Access Control**: Different roles for subscribers and newsletter owners (customers)
- **Newsletter Management**: Create, update, and delete newsletters
- **Subscription System**: Subscribe to and unsubscribe from newsletters
- **User Dashboard**: Personalized dashboard experience based on user role

## Technologies Used

- **Backend**: Laravel 10, PHP 8+
- **Frontend**: Blade templates, TailwindCSS
- **Database**: MySQL 
- **Development Environment**: Docker for containerized development

## Prerequisites

- Docker and Docker Compose
- Composer
- Node.js and NPM

## Installation

### Using Docker

1. Clone the repository:
   ```
   git clone <repository-url>
   cd fsu24d-systemutveckling-uppgift-2-saas-kontohantering-innoveraz
   ```

2. Copy the environment file:
   ```
   cp .env.example .env
   ```

3. Start the Docker containers:
   ```
   docker-compose up -d
   ```

4. Install PHP dependencies:
   ```
   docker-compose exec app composer install
   ```

5. Generate application key:
   ```
   docker-compose exec app php artisan key:generate
   ```

6. Run migrations and seed the database:
   ```
   docker-compose exec app php artisan migrate --seed
   ```

7. Install frontend dependencies and build:
   ```
   npm install
   npm run dev
   ```

### Manual Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   cd fsu24d-systemutveckling-uppgift-2-saas-kontohantering-innoveraz
   ```

2. Copy the environment file:
   ```
   cp .env.example .env
   ```

3. Install PHP dependencies:
   ```
   composer install
   ```

4. Generate application key:
   ```
   php artisan key:generate
   ```

5. Configure your database in the .env file

6. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```

7. Install frontend dependencies and build:
   ```
   npm install
   npm run dev
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

## Usage

After installation, you can access the application at http://localhost (Docker) or http://localhost:8000 (manual installation).

### User Roles

- **Subscriber**: Can subscribe to and view newsletters
- **Customer**: Can create and manage their own newsletters, view subscriber lists

### Main Routes

- `/`: Home page
- `/register`: Create a new account
- `/login`: Login to existing account
- `/dashboard`: User dashboard
- `/newsletters`: Browse available newsletters
- `/my-subscriptions`: View subscribed newsletters (subscriber role)
- `/my-subscribers`: View newsletter subscribers (customer role)
- `/newsletters/create`: Create a new newsletter (customer role)

## Testing

Run the test suite with:

```
php artisan test
```

Or using Pest:

```
./vendor/bin/pest
```

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
