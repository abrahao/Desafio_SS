# API Project

## Features

## Project Structure

## Requirements

## Installation
## Running the API
You can run the API using a PHP built-in server. From the `api` directory, execute the following command:

php -S localhost:8000

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
- 
### Protected Endpoint
- **URL:** `/protected-endpoint`
- **Method:** `GET`
- **Authorization:** Bearer token required.
- 
### Token Validation
- **URL:** `/validate-token`
- **Method:** `POST`
- **Authorization:** Bearer token required.
