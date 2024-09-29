# API Project

This project is a RESTful API built with PHP, utilizing JWT (JSON Web Tokens) for authentication. It allows users to register, log in, and access protected resources.

## Features

- User registration
- User login with JWT authentication
- Logout functionality
- Protected endpoints requiring token validation

## Project Structure

api/
...

## Requirements

- PHP 7.4 or higher
- Composer
- PostgreSQL database
  
## Installation
1. Clone the repository and enter in the directory:

   ```bash
   git clone 
   cd api

2. Install dependencies:

   ```bash
   composer install

## Database

Change system user directory access permission to postgres user:

* `sudo chmod o+rx /home/<your-user>`

Access PostgreSQL as the `postgres` user:

* `sudo -i -u postgres`

Navigate to the api directory:
* `cd /home/<your-user>/path/to/api/`

Create database `abrahao`:
* `createdb abrahao`

Restore the database from an SQL file:

* `psql -U postgres -d abrahao -f abrahao.sql`

Exit to the PostgresSql:
* `\q`

Exit to the user `postgresSQL`
  * `exit`

## Running the API
You can run the API using a PHP built-in server. From the `api` directory, execute the following command:

* `php -S localhost:8000`


## Endpoints 
### User Registration
- **URL:** `/register`
- **Method:** `POST`
- **Body:** JSON

  ```json
  {
    "name": "User Name",
    "email": "user@email.com",
    "password": "password"
  }

### User Login

- **URL:** `/login`
- **Method:** `POST`
- **Body:** JSON

  ```json
  {
    "email": "user@email.com",
    "password": "password"
  }

### User Logout

- **URL:** `/logout`
- **Method:** `POST`
- **Authorization:** Bearer token required.

### Protected Endpoint

- **URL:** `/protected-endpoint`
- **Method:** `GET`
- **Authorization:** Bearer token required.
  
### Token Validation

- **URL:** `/validate-token`
- **Method:** `POST`
- **Authorization:** Bearer token required.
