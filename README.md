
# Todo Application

A simple Todo Application built with Laravel and Sanctum for API authentication.

## Features

- User authentication using Laravel Sanctum
- Create, update, and manage Todo lists
- Mark Todo items as `completed` or `skipped`
- API endpoints for interacting with Todo items

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL or any other database
- Node.js and NPM

## Installation

### 1. Clone the Repository

Clone the project to your local machine:

```bash
git clone https://github.com/DeepakDums1998/todo.git
cd todo
```

### 2. Install Dependencies

#### For PHP Dependencies

Make sure you have Composer installed. If not, you can download it from [here](https://getcomposer.org/).

Run the following command to install PHP dependencies:

```bash
composer install
```

#### For JavaScript Dependencies

Make sure you have Node.js and NPM installed. You can download them from [here](https://nodejs.org/).

Install JavaScript dependencies by running:

```bash
npm install
```

### 3. Set Up Environment Variables

Create a `.env` file:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Run Migrations

Run the migrations to set up the database:

```bash
php artisan migrate
```

### 5. Seed Dummy Data (Optional)

To seed the database with dummy data:

```bash
php artisan db:seed
```

### 6. Serve the Application

Start the Laravel development server:

```bash
php artisan serve
```

By default, the application will be accessible at [http://localhost:8000](http://localhost:8000).

### 7. Compile Assets

Run the following command to compile the front-end assets:

```bash
npm run dev
```

## API Endpoints

### Authentication

#### 1. Login

- **Method**: `POST`
- **URL**: `/api/login`
- **Parameters**:
    - `username` (string)
    - `password` (string)

#### 2. Logout

- **Method**: `POST`
- **URL**: `/api/logout`
- **Headers**:
    - `Authorization: Bearer {token}`

### Todo Management

#### 1. Get All Todos

- **Method**: `GET`
- **URL**: `/api/todos`
- **Headers**:
    - `Authorization: Bearer {token}`

#### 2. Create a Todo

- **Method**: `POST`
- **URL**: `/api/todos`
- **Parameters**:
    - `title` (string)
    - `priority` (string: `high`, `normal`, `low`)
    - `item_titles[]` (array of strings)

#### 3. Update Todo Status

- **Method**: `PATCH`
- **URL**: `/api/todos/{todoId}/status`
- **Parameters**:
    - `status` (string: `completed`, `skipped`)

#### 4. Update Todo Item Status

- **Method**: `PATCH`
- **URL**: `/api/todos/{todoId}/items/{todoItemId}/status`
- **Parameters**:
    - `status` (string: `completed`, `skipped`)

## Testing with Postman

You can use Postman or any other API testing tool to test the above API endpoints.

### Authentication Example

**Login API**
- URL: `http://localhost:8000/api/login`
- Method: `POST`
- Body (form-data):
    - `username`: testuser
    - `password`: password123

**Logout API**
- URL: `http://localhost:8000/api/logout`
- Method: `POST`
- Headers:
    - `Authorization: Bearer {token}`

### Todo Management Example

**Get Todos API**
- URL: `http://localhost:8000/api/todos`
- Method: `GET`
- Headers:
    - `Authorization: Bearer {token}`

**Create Todo API**
- URL: `http://localhost:8000/api/todos`
- Method: `POST`
- Body (form-data):
    - `title`: My New Todo
    - `priority`: normal
    - `item_titles[]`: Task 1, Task 2

**Update Todo Status API**
- URL: `http://localhost:8000/api/todos/{todoId}/status`
- Method: `PATCH`
- Body (form-data):
    - `status`: completed

**Update Todo Item Status API**
- URL: `http://localhost:8000/api/todos/{todoId}/items/{todoItemId}/status`
- Method: `PATCH`
- Body (form-data):
    - `status`: skipped

## Troubleshooting

- Ensure your MySQL server is running.
- If you encounter issues with migrations or seeding, run:

```bash
php artisan migrate:fresh --seed
```

This will reset your database and reseed it with fresh data.

## License

The code is available under the [MIT License](LICENSE).
