<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Vue Chat Application

Welcome to the Laravel Vue Chat Application! This project combines the power of Laravel for the backend, Vue.js for the frontend, and Breeze for authentication, all styled using Tailwind CSS.

## Installation

1. Clone the repository: 
    ```bash
    git clone https://github.com/farazkhan2000/laravel-vue-chat-app.git
    ```

2. Navigate to the project directory:
    ```bash
    cd laravel-vue-chat-app
    ```

3. Install PHP dependencies:
    ```bash
    composer install
    ```

4. Install JavaScript dependencies:
    ```bash
    npm install
    ```

5. Set up your environment:
    - Copy `.env.example` to `.env`
    - Update your `.env` file with your database and Pusher credentials.

6. Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

7. Compile the frontend assets:
    ```bash
    npm run dev
    ```

8. Start the development server:
    ```bash
    php artisan serve
    ```

9. Access the application in your browser at `http://localhost:8000`

## Technologies Used

- **Laravel**: Backend framework for building the application.
- **Vue.js**: JavaScript framework for the frontend.
- **Breeze**: Simple authentication scaffolding.
- **Tailwind CSS**: Utility-first CSS framework for styling.
- **Pusher**: Real-time communication service for implementing chat functionality.

## Features

- **Real-time Messaging**: Communicate in real-time using Pusher and Laravel Echo.
- **User Authentication**: Secure user authentication with Laravel Breeze.
- **Responsive Design**: Styled using Tailwind CSS for a clean, responsive UI.
- **Modular Components**: Vue.js components for a smooth, dynamic user experience.

## Running the Application

1. Ensure your database is set up and configured in the `.env` file.
2. Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```
3. Compile frontend assets:
    ```bash
    npm run dev
    ```
4. Start the development server:
    ```bash
    php artisan serve
    ```
5. Open your browser and go to `http://localhost:8000` to view the application.

## Contributing

Contributions are welcome! Feel free to fork the repository, make your changes, and submit a pull request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
