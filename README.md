# Test Laravel - Courier Management System

This project is a technical assessment implementation for a Courier Management System built with Laravel 11. It provides a RESTful API for managing courier master data with advanced filtering, searching, and sorting capabilities.

## Technical Specifications

### 1. Courier Master Data
- **Fields**: `id`, `name`, `email` (unique), `phone_number`, `level` (1-5), `vehicle_type`, `is_active`.
- **Level**: Supports tiers from 1 to 5.

### 2. Features & API Endpoints
- **CRUD Operations**: Complete Create, Read, Update, and Delete functionality.
- **Advanced Listing (`index`)**:
  - **Pagination**: Built-in response pagination.
  - **Search**: Search by name (supports partial and multi-term matches, e.g., `?search=budi+agung`).
  - **Level Filtering**: Filter by specific levels (e.g., `?level=2,3`).
  - **Sorting**: Default sort by name. Optional override to sort by registration date (`?sort=date`).
- **Show**: Retrieve full details of a single courier.
- **Validation**: Comprehensive input validation for Store and Update requests.

### 3. Requirements
- PHP 8.2+
- Composer
- SQLite (configured by default for easy testing)

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/sfebriheri/test-laravel.git
   cd test-laravel
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database (SQLite)**:
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

## Usage

### API Reference

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/couriers` | List couriers with search, filter, and sort |
| `GET` | `/api/couriers/{id}` | Get courier details |
| `POST` | `/api/couriers` | Create new courier |
| `PUT` | `/api/couriers/{id}` | Update courier data |
| `DELETE` | `/api/couriers/{id}` | Delete a courier |

#### Query Parameters for `GET /api/couriers`
- `search`: Search name (e.g., `?search=budiono`)
- `level`: Level filter (e.g., `?level=2,3`)
- `sort`: `name` (default) or `date`
- `direction`: `asc` or `desc`

## Testing

The project is fully covered by automated Feature Tests.
```bash
php artisan test
```

Tests include:
- Successful CRUD operations.
- Verification of data persistence and deletion.
- Search logic validation.
- Filtering and sorting accuracy.
- Validation error handling.

## Standards Followed
- RESTful API design.
- PSR-12 Coding Standards.
- Laravel Best Practices (Form Requests, Model Factories, Mass Assignment Protection).
- Feature-driven testing approach.
