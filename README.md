<p align="center"><img src="public/images/logo.png" width="250" alt="BookI Logo"></a></p>

<a name="about"></a>
## About BookI

BookI is an online book store project with an admin panel where you can add or edit books. It is created using the Laravel PHP Framework.

<a name="installation"></a>
## Installation

In order to run the project locally, you need to execute the following steps:
1. Clone the repository
    ```sh
    git clone https://github.com/BogomilDochev/BookI.git
    ```

2. Cd into the project root directory
    ```sh
    cd BookI
    ```

3. Install composer dependencies
    ```sh
    composer install
    ```

4. Install NPM dependencies
    ```sh
    npm install
    ```

5. Copy the .env file
    ```sh
    cp .env.example .env
    ```

6. Generate an app encryption key
    ```sh
    php artisan key:generate
    ```

7. Create an empty database for the application

8. In the .env file, add database information and change FILESYSTEM_DISK from 'local' to 'public'

9. Migrate and seed the database
    ```sh
    php artisan migrate --seed
    ```

10. Npm run build
    ```sh
    npm run build
    ```

11. Create a symbolic link
    ```sh
    php artisan storage:link
    ```

12. Run server
    ```sh
    php artisan serve
    ```

<a name="project"></a>
## In the project
In order to be able to add or edit books in the web application, you need to create account with the name Bogomil. If you create a project with another name, you will have only the rights to add books to favorites, add books to cart and leave a comment under a book.

