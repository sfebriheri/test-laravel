# Courier Management API

Simple Laravel API for managing Courier master data.

## Features
- CRUD operations for Courier.
- Pagination for index.
- Search by name (supports partial/multi-term match).
- Filter by level (1-5).
- Sort by name (default) or date created.
- Comprehensive Feature Tests.

## Requirements
- PHP 8.2+
- Composer
- SQLite (default)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/sfebriheri/laravel-courier-crud.git
   cd laravel-courier-crud
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

5. Run tests:
   ```bash
   php artisan test
   ```

## API Endpoints

### 1. List Couriers
`GET /api/couriers`

**Parameters:**
- `search`: Search by name (e.g., `?search=budi+agung`)
- `level`: Filter by level (e.g., `?level=1,2,3`)
- `sort`: Sort field (`name` or `date`)
- `direction`: `asc` or `desc`
- `per_page`: Pagination size (default 10)

### 2. Show Courier
`GET /api/couriers/{id}`

### 3. Store Courier
`POST /api/couriers`

**Body:**
```json
{
    "name": "Budiono Hadi Agung",
    "email": "budi@example.com",
    "phone_number": "08123456789",
    "level": 3,
    "vehicle_type": "Motorcycle"
}
```

### 4. Update Courier
`PUT/PATCH /api/couriers/{id}`

### 5. Delete Courier
`DELETE /api/couriers/{id}`

## Testing
The project includes feature tests covering all CRUD operations and query logic. Run them using:
```bash
php artisan test
```
# test-laravel
