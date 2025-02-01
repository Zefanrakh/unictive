# Laravel User Management Application

A feature-rich user management application built with Laravel, implementing authentication, profile management, and CRUD operations with role-based access control (RBAC).

## Features

-   **JWT Authentication** with Tymon/JWTAuth
-   **User Management**: Add, edit, delete, and list users
-   **Profile Management**: Update personal details and hobbies
-   Role-based navigation (Admin access to "Users" and "Create User" pages)

## Prerequisites

-   PHP >= 8.0
-   Composer
-   Node.js & npm
-   Database (MySQL, PostgreSQL, or SQLite)
-   Laravel 8 or later

---

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
npm run dev
```

### 4. Configure the Environment

Copy the example `.env` file and configure it with your database and JWT settings:

```bash
cp .env.example .env
```

### 5. Generate Application Keys

```bash
php artisan key:generate
php artisan jwt:secret
```

### 6. Run Migrations and Seed Database

```bash
php artisan migrate --seed
```

---

## Running the Application

### 1. Start the Laravel Development Server

```bash
php artisan serve
```

The application will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Key Endpoints

### Authentication

-   **Login**: `POST /api/login`
    -   Payload: `{ "email": "user@example.com", "password": "password" }`
-   **Register**: `POST /api/register`
    -   Payload: `{ "name": "User Name", "email": "user@example.com", "password": "password" }`

### User Management

-   **List Users**: `GET /api/users`
-   **User Details**: `GET /api/users/{id}`
-   **Create User**: `POST /api/users/create`
-   **Update User**: `POST /api/users/{id}`
-   **Delete User**: `DELETE /api/users/{id}`

---

## Folder Structure

-   **Controllers**:
    -   `App/Http/Controllers/Web`: Handles web interactions (Blade views).
    -   `App/Http/Controllers/Api`: Handles API interactions.
-   **Resources**:
    -   `resources/views`: Contains Blade templates for the frontend.
-   **Public**:
    -   `public/css`: Custom CSS files.
    -   `public/js`: Custom JavaScript files.

---

## Role-Based Navigation

-   **Admin**: Can access all features, including "Users" and "Create User" pages.
-   **User**: Limited to "Profile" and "Dashboard" pages.

---

## Contributors

1. Sadrakh Zefanya Sitompul - Fullstack Developer

<br/>
<br/>
<br/>

# API: User Management

## End-point: Get Current User

### Method: GET

> ```
> {{base_url}}/api/user
> ```

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Response: 200

```json
{
    "user": {
        "id": 2,
        "name": "Zefan",
        "email": "zefanyasadrakh@gmail.com",
        "role": "admin",
        "created_at": "2025-02-01T04:58:11.000000Z",
        "updated_at": "2025-02-01T04:58:11.000000Z"
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Get Users

### Method: GET

> ```
> {{base_url}}/api/users?page=1&per_page=10&sort=created_at&order=desc
> ```

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Query Params

| Param    | value      |
| -------- | ---------- |
| page     | 1          |
| per_page | 10         |
| sort     | created_at |
| order    | desc       |

### Response: 200

```json
{
    "data": [
        {
            "id": 4,
            "name": "Louis",
            "email": "louis@gmail.com",
            "role": "admin",
            "hobbies": []
        },
        {
            "id": 3,
            "name": "Jasmine",
            "email": "jasmine@gmail.com",
            "role": "user",
            "hobbies": []
        },
        {
            "id": 2,
            "name": "Zefan",
            "email": "zefanyasadrakh@gmail.com",
            "role": "admin",
            "hobbies": []
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/users?page=1",
        "last": "http://localhost:8000/api/users?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/users?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/users",
        "per_page": 10,
        "to": 3,
        "total": 3
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Get User Detail

### Method: GET

> ```
> {{base_url}}/api/users/4
> ```

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Response: 200

```json
{
    "data": {
        "id": 4,
        "name": "Louis",
        "email": "louis@gmail.com",
        "role": "admin",
        "hobbies": []
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Register

### Method: POST

> ```
> {{base_url}}api/register
> ```

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Body (**raw**)

```json
{
    "name": "Alice",
    "email": "alice@gmail.com",
    "password": "alicealice"
}
```

### Response: 201

```json
{
    "message": "User created successfully",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzM4Mzk4MzY5LCJleHAiOjE3Mzg0MDE5NjksIm5iZiI6MTczODM5ODM2OSwianRpIjoidVRSTFZGR2lkWmZQcDUweSIsInN1YiI6IjYiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.0h4VCHdwRFo-ia4PZgQC7IGfuz_yscdlROOjnYnyiLc",
    "user": {
        "name": "Alice",
        "email": "alice@gmail.com",
        "role": "admin",
        "updated_at": "2025-02-01T08:26:09.000000Z",
        "created_at": "2025-02-01T08:26:09.000000Z",
        "id": 6
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Login

### Method: POST

> ```
> {{base_url}}/api/login
> ```

### Body (**raw**)

```json
{
    "email": "zefanyasadrakh@gmail.com",
    "password": "zefanzefan"
}
```

### Response: 200

```json
{
    "message": "Login successful",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk4MzgxLCJleHAiOjE3Mzg0MDE5ODEsIm5iZiI6MTczODM5ODM4MSwianRpIjoicFdnOEw1SlpSZmRKSTBaVyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.EwV9qzjUUcmGubeM5DlXtFVPA4MKMb1gwC42JKaOI5c",
    "user": {
        "id": 2,
        "name": "Zefan",
        "email": "zefanyasadrakh@gmail.com",
        "role": "admin",
        "created_at": "2025-02-01T04:58:11.000000Z",
        "updated_at": "2025-02-01T04:58:11.000000Z"
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Create User

### Method: POST

> ```
> {{base_url}}/api/users
> ```

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Body (**raw**)

```json
{
    "name": "Tyler",
    "email": "tyler@gmail.com",
    "password": "tylertyler",
    "role": "user"
}
```

### Response: 201

```json
{
    "message": "User created successfully",
    "user": {
        "name": "Tyler",
        "email": "tyler@gmail.com",
        "role": "user",
        "updated_at": "2025-02-01T08:27:02.000000Z",
        "created_at": "2025-02-01T08:27:02.000000Z",
        "id": 7
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Update User

### Method: POST

> ```
> {{base_url}}/api/users/7
> ```

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Body (**raw**)

```json
{
    "hobbies": ["Strip Dancing"]
}
```

### Response: 200

```json
{
    "message": "User updated successfully",
    "user": {
        "id": 7,
        "name": "Tyler",
        "email": "tyler@gmail.com",
        "role": "user",
        "hobbies": ["Strip Dancing"]
    }
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Delete User

### Method: DELETE

> ```
> {{base_url}}}/api/users/5
> ```

### Headers

| Content-Type  | Value                                                                                                                                                                                                                                                                                                                               |
| ------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzM4Mzk3NjE4LCJleHAiOjE3Mzg0MDEyMTgsIm5iZiI6MTczODM5NzYxOCwianRpIjoiVUl5RmQ1WEZIVGZod1d1MiIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.mzMpU0ttJbZNFfbKP6xwQfbUCpgARO4grjcrhXNP6XQ |

### Headers

| Content-Type | Value            |
| ------------ | ---------------- |
| Accept       | application/json |

### Response: 200

```json
{
    "message": "User deleted successfully"
}
```

⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

---

Powered By: [postman-to-markdown](https://github.com/bautistaj/postman-to-markdown/)
