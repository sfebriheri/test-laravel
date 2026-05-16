# Laravel Developer Technical Assessment

This repository contains the implementation of a technical assessment for a Laravel Developer position. The task involves creating a standalone API module for managing **Courier Master Data** with specific functional requirements.

## 🚀 Overview

The project provides a robust RESTful API built with **Laravel 11**, designed to handle courier management with features such as multi-term search, level-based filtering, and dynamic sorting.

## 🛠 Technical Stack
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: SQLite (Automated setup)
- **Testing**: PHPUnit / Laravel Feature Testing

## 📋 Features & Implementation Details

### 1. Courier Module (Master Data)
The `Courier` model handles the following attributes:
- `name`: Full name of the courier.
- `email`: Unique email address.
- `phone_number`: Contact number.
- `level`: Experience level (Scale 1-5).
- `vehicle_type`: Assigned vehicle.
- `is_active`: Status flag.

### 2. API Endpoints

| Endpoint | Method | Features |
| :--- | :--- | :--- |
| `GET /api/couriers` | Index | Pagination, Multi-term Search, Level Filtering, Sorting |
| `POST /api/couriers` | Store | Validation (Required fields, unique email, level range) |
| `GET /api/couriers/{id}` | Show | Detailed view of a single courier |
| `PUT /api/couriers/{id}` | Update | Partial/Full update with unique email validation |
| `DELETE /api/couriers/{id}` | Destroy | Soft/Hard deletion verification |

### 3. Advanced Query Capabilities
- **Search**: Supports multi-word matching (e.g., `?search=budi+agung` matches "Budiono Hadi Agung").
- **Filtering**: Level-based filtering via comma-separated values (e.g., `?level=2,3`).
- **Sorting**: Defaults to `name` ascending. Can be overridden using `?sort=date` for registration date.

## 🚦 Getting Started

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/sfebriheri/test-laravel.git
cd test-laravel

# 2. Install PHP dependencies
composer install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Database initialization
touch database/database.sqlite
php artisan migrate
```

### Running Tests
A comprehensive suite of feature tests ensures the reliability of the CRUD operations and search/filter logic.
```bash
php artisan test
```

## 🧪 Testing Coverage
- **Persistence**: Verification that data is correctly stored and removed from the database.
- **Validation**: Testing of input rules (required, unique, min/max).
- **Logic**: Verification of search term splitting and level filtering logic.
- **Pagination**: Ensuring the response structure adheres to standard pagination formats.

## 📄 Standards & Best Practices
- **Form Requests**: Used for clean controller logic and robust validation.
- **Model Factories**: Implemented for consistent test data generation.
- **RESTful Principles**: Adherence to standard HTTP methods and status codes.
- **DRY Principle**: Shared logic encapsulated within the model and requests.
