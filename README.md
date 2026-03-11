## Destination API

This project is a simple **Laravel REST API** for managing travel destinations.  
It allows users to create, update, delete, retrieve, paginate, and search destinations.

### Features

- Create a destination
- Retrieve a destination by ID
- Update a destination
- Delete a destination
- Paginate destinations
- Search destinations using filters:
  - `activity`
  - `max_budget`
  - `travel_month`

### Tech Stack

- Laravel
- MongoDB
- Repository Pattern
- Service Layer
- Request Validation

### API Endpoints

| Method | Endpoint | Description |
|------|------|------|
| GET | `/api/destinations` | Get paginated destinations |
| GET | `/api/destinations/{id}` | Get destination by ID |
| POST | `/api/destinations` | Create destination |
| PUT | `/api/destinations/{id}` | Update destination |
| DELETE | `/api/destinations/{id}` | Delete destination |
| GET | `/api/destinations/search` | Search destinations |

### Search Parameters

| Parameter | Description |
|------|------|
| `activity` | Filter by activity |
| `max_budget` | Maximum allowed average cost |
| `travel_month` | Filter by best travel month |
