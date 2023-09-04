# Salesmen API

## Overview

This is an API implementation for managing salesmen, based on the OpenAPI specification provided. The API is built using Laravel and offers various endpoints for CRUD operations on salesmen and codelists.

### Live Version

The live version of the app is available at [https://holy-pine-3698.fly.dev](https://holy-pine-3698.fly.dev).

## Getting Started

### Prerequisites

- PHP 8.2
- Composer
- Docker (for Laravel Sail)

### Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and update the environment variables
4. Run `php artisan key:generate`
5. Run `php artisan migrate:fresh --seed` to create and seed the database tables

### Using Laravel Sail

This project is configured to use Laravel Sail, which provides a Docker environment for Laravel. To start the Sail environment, run:

```bash
./vendor/bin/sail up
```

## Endpoints

### Salesmen

- `GET /salesmen`: List all salesmen
- `POST /salesmen`: Create a new salesman
- `GET /salesmen/{salesman_uuid}`: Retrieve a specific salesman
- `PUT /salesmen/{salesman_uuid}`: Update a specific salesman
- `DELETE /salesmen/{salesman_uuid}`: Delete a specific salesman

### Codelists

- `GET /codelists`: Retrieve codelists for marital statuses, genders, and titles.

### Authentication

This API uses Laravel Sanctum for authentication. Tokens are used as bearer tokens for API requests.

#### Generating a Token

For demonstration purposes, a token for the first user can be generated and retrieved at the `GET /token` endpoint.

#### Example Authenticated Request Header

To make an authenticated request, include the following header:

```shell
Authorization: Bearer YOUR_TOKEN_HERE
````

## Seeding Data

The project includes a CSV seeder for salesmen. The CSV file is located at `storage/database/seeders/salesmen.csv`. To seed the database, run:

```bash
php artisan db:seed
```
