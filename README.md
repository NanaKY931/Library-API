# Contacts CRUD API

A PHP + MySQL REST API for managing phone contacts. Supports full CRUD operations.

## Endpoints

All endpoints are in the `actions/` subfolder and return JSON.

| Endpoint | Method | Description |
|---|---|---|
| `actions/read_all.php` | GET | Get all contacts |
| `actions/read_one.php?id=` | GET | Get a single contact by ID |
| `actions/create.php` | POST | Create a new contact (`name`, `phone`, optional `email`) |
| `actions/update.php` | POST | Update a contact (`id`, `name`, `phone`, optional `email`) |
| `actions/delete.php` | POST | Delete a contact (`id`) |

## Setup

1. Import `database.sql` into MySQL to create the `contacts_db` database and seed data.
2. Place the project folder in your web server's document root.
3. Access endpoints via `http://<your-server>/<project-folder>/actions/`

## Example Usage

```bash
# Read all contacts
curl http://localhost/website/Library%20API/actions/read_all.php

# Create a contact
curl -X POST http://localhost/website/Library%20API/actions/create.php \
  -d "name=John Doe" -d "phone=0240000000"

# Read one contact
curl "http://localhost/website/Library%20API/actions/read_one.php?id=1"

# Update a contact
curl -X POST http://localhost/website/Library%20API/actions/update.php \
  -d "id=1" -d "name=Jane Doe" -d "phone=0209999999"

# Delete a contact
curl -X POST http://localhost/website/Library%20API/actions/delete.php -d "id=1"
```
