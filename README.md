
Project Setup Instructions

Prerequisites
Before starting, make sure you have the following installed:

- PHP 8.4 or higher
- Composer
- MySQL (or any database of your choice)

Steps to Get Started

1. Clone the Repository
   Start by cloning the project repository to your local machine:

   git clone https://github.com/SarmadFayyaz/CodeTest.git
   cd CodeTest

2. Copy `.env.example` to `.env`
   Copy the `.env.example` file to `.env` to set up your environment variables:

   cp .env.example .env

3. Create the Database
   Create a new database in MySQL (or your preferred database) with a suitable name for the project.

   Example MySQL query:
   CREATE DATABASE your_database_name;

4. Set Database Credentials
   Open the `.env` file and set the appropriate database credentials:

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

5. Ensure PHP 8.4 is Installed
   Verify that PHP 8.4 is installed on your system:

   php -v

6. Install Composer Dependencies
   Install the required dependencies using Composer:

   composer install

7. Generate Application Key
   Run the following command to generate a new application key:

   php artisan key:generate

8. Run Database Migrations
   Apply the database migrations to set up the database schema:

   php artisan migrate

9. Seed the Database
   Populate the database with initial data using the database seeder:

   php artisan db:seed

10. Start the Application
    Run the following command to start the local development server:

    php artisan serve

Additional Notes

- If you encounter any issues with migrations or database seeds, ensure your database credentials in `.env` are correct.
- You can access the application locally by visiting [http://127.0.0.1:8000] after completing the setup.


API Endpoints

1. **Authentication API**

   - `127.0.0.1:8000/api/login` - User login **POST**
   - `127.0.0.1:8000/api/logout` - User logout **POST**
   - `127.0.0.1:8000/api/register` - User registration **POST**

2. **Language API**

   - `127.0.0.1:8000/api/language` - Get all languages **GET|HEAD**
   - `127.0.0.1:8000/api/language` - Create a new language **POST**
   - `127.0.0.1:8000/api/language/{language}` - Get a specific language by ID **GET|HEAD**
   - `127.0.0.1:8000/api/language/{language}` - Update a language by ID **PUT|PATCH**
   - `127.0.0.1:8000/api/language/{language}` - Delete a language by ID **DELETE**

3. **Translation API**

   - `127.0.0.1:8000/api/search` - Search translations **GET|HEAD**
   - `127.0.0.1:8000/api/translation` - Get all translations **GET|HEAD**
   - `127.0.0.1:8000/api/translation` - Create a new translation **POST**
   - `127.0.0.1:8000/api/translation/{translation}` - Get a specific translation by ID **GET|HEAD**
   - `127.0.0.1:8000/api/translation/{translation}` - Update a translation by ID **PUT|PATCH**
   - `127.0.0.1:8000/api/translation/{translation}` - Delete a translation by ID **DELETE**
