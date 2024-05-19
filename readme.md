# RESTful API for UTS

This repository contains a RESTful API project for the Ujian Tengah Semester (UTS) assignment.

## Installation

### Prerequisites

- PHP (recommended version 7.4 or higher)
- Composer
- MySQL or any other database supported by Laravel
- Laravel Valet, Laravel Homestead, or any other local development environment (optional)

### Installation Steps

1. **Navigate to the Project Directory:**

    ```bash
    cd utspbfhusni
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

3. **Environment Configuration:**

    - Create a copy of the `.env.example` file and name it `.env`:

        ```bash
        cp .env.example .env
        ```

    - Configure your database connection in the `.env` file:

        ```dotenv
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_username
        DB_PASSWORD=your_database_password
        ```

4. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

5. **Database Migration:**

    ```bash
    php artisan migrate
    ```

6. **Serve the Application:**

    ```bash
    php artisan serve
    ```

    By default, the application will be served at [http://localhost:8000](http://localhost:8000).

## Features

- **Authentication:** Users can register, log in, log out, and refresh their authentication tokens.
- **User Management:** CRUD operations for users, including viewing, creating, updating, and deleting users.
- **Product Management:** CRUD operations for products, including viewing, creating, updating, and deleting products.
- **Category Management:** CRUD operations for product categories, including viewing, creating, updating, and deleting categories.

## Additional Steps

- **Optional:** If you want to test the API endpoints, you can import the provided Postman collection (`utshusni.postman_collection.json`) into your Postman application.

Now, your Laravel project should be up and running locally. You can access it through your web browser or test the API endpoints using a tool like Postman.

If you encounter any issues during the installation process, refer to the Laravel documentation or feel free to ask for further assistance!
