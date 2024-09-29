# API Project

This project is a RESTful API built with PHP, utilizing JWT (JSON Web Tokens) for authentication. It allows users to register, log in, and access protected resources.

## Features

- User registration
- User login with JWT authentication
- Logout functionality
- Protected endpoints requiring token validation

## Project Structure


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

## Running the API

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
