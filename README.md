# Liason Backend API Documentation

## Base URL

```
http://92.205.128.143/liason/public/api/
```

## Endpoints

### User Registration

- **Endpoint**: `/register`
- **Method**: POST
- **Request Body**:

```json
{
    "firstname": "string",
    "middlename": "string",
    "lastname": "string",
    "email": "string",
    "password": "string",
    "is_sla": "boolean",
    "level": "integer",
    "photo": "string (URL)"
}
```

### User Login

- **Endpoint**: `/login`
- **Method**: POST
- **Request Body**:

```json
{
    "email": "string",
    "password": "string"
}
```

### Password Reset

- **Endpoint**: `/reset-password`
- **Method**: POST
- **Request Body**:

```json
{
    "email": "string"
}
```

### User Logout

- **Endpoint**: `/logout`
- **Method**: POST

### Change Password

- **Endpoint**: `/change-password`
- **Method**: POST
- **Request Body**:

```json
{
    "current_password": "string",
    "new_password": "string"
}
```

### Token Validation

- **Endpoint**: `/check-token`
- **Method**: GET

---

# Super Admin Endpoints

### Dashboard Statistics

- **Endpoint**: `/super-admin/dashboard`
- **Method**: GET

### Summarized Dashboard Statistics

- **Endpoint**: `/super-admin/small-dashboard`
- **Method**: GET

### Move User

- **Endpoint**: `/super-admin/move-user`
- **Method**: POST
- **Request Parameters**:

```json
{
    "la_id": "integer",
    "old_user_id": "integer",
    "new_user_id": "integer"
}
```

### Generate Registration Link

- **Endpoint**: `/super-admin/generate-registration-link`
- **Method**: POST
- **Request Parameters**:

```json
{
    "code": "string"
}
```

### Get User Details

- **Endpoint**: `/super-admin/get-user/{id}`
- **Method**: GET

### Fetch Aides

- **Endpoint**: `/super-admin/fetch-aides`
- **Method**: POST
- **Request Parameters**:

```json
{
    "per_page": "integer",
    "page": "integer"
}
```

### Get Users

- **Endpoint**: `/super-admin/get-users`
- **Method**: POST
- **Request Parameters**:

```json
{
    "per_page": "integer",
    "page": "integer"
}
```

### Add User

- **Endpoint**: `/super-admin/add-user`
- **Method**: POST
- **Request Parameters**:

```json
{
    "firstname": "string",
    "middlename": "string",
    "lastname": "string",
    "email": "string",
    "bio": "string",
    "party": "string",
    "assembly": "string",
    "leg_house": "string",
    "position": "string",
    "phone": "string",
    "photo": "string (URL)"
}
```

### Activate/Deactivate User

- **Endpoint**: `/super-admin/activation`
- **Method**: POST
- **Request Parameters**:

```json
{
    "user_id": "integer",
    "active": "boolean"
}
```

### Suspend/Lift Suspension on User

- **Endpoint**: `/super-admin/suspension`
- **Method**: POST
- **Request Parameters**:

```json
{
    "user_id": "integer",
    "suspend": "boolean"
}
```

### Get Rooms

- **Endpoint**: `/super-admin/rooms`
- **Method**: GET

### Get Teams

- **Endpoint**: `/super-admin/teams`
- **Method**: GET

### Get Room Owner Details

- **Endpoint**: `/super-admin/room-owner-details`
- **Method**: POST
- **Request Parameters**:

```json
{
    "user_id": "integer"
}
```

### Delete User

- **Endpoint**: `/super-admin/delete-user/{id}`
- **Method**: DELETE

### Edit User

- **Endpoint**: `/super-admin/edit-user/{id}`
- **Method**: POST
- **Request Parameters**:

```json
{
    "firstname": "string",
    "middlename": "string",
    "lastname": "string",
    "email": "string",
    "bio": "string",
    "party": "string",
    "assembly": "string",
    "leg_house": "string",
    "position": "string",
    "phone": "string",
    "photo": "string (URL)"
}
```

---

# LA API Documentation

## Authentication

All endpoints require authentication via JWT token. Include the token in the `Authorization` header of your requests.

## LA Routes

### Create Report

- **Endpoint**: `/la/report/create`
- **Method**: POST
- **Request Body**:

```json
{
    "title": "string",
    "case_details": "string",
    "tag": "string",
    "category": ["string"],
    "attachments": ["string"],
    "urgency_level": "string",
    "deadline": "date",
    "notes": "string",
    "format": [],
    "reference_materials": ["string"],
    "stage": "integer",
    "room_id": "integer",
    "rerun": "boolean",
    "agreement": "boolean"
}
```

### Edit Report

- **Endpoint**: `/la/report/edit`
- **Method**: PATCH
- **Request Body**:

```json
{
    "id": "integer",
    "title": "string",
    "case_details": "string",
    "tag": "string",
    "category": ["string"],
    "attachments": ["string"],
    "urgency_level": "string",
    "deadline": "date",
    "notes": "string",
    "format": [],
    "reference_materials": ["string"],
    "stage": "integer",
    "room_id": "integer",
    "rerun": "boolean",
    "agreement": "boolean"
}
```

### Get All Reports

- **Endpoint**: `/la/report/all/{complete}`
- **Method**: GET
- **Parameters**:
    - `complete`: "true" or "false" (string) - Indicates whether to retrieve completed reports or not.

### Get Single Report

- **Endpoint**: `/la/report/single/{id}`
- **Method**: GET
- **Parameters**:
    - `id`: Report ID (integer)

### Post Report

- **Endpoint**: `/la/report/post`
- **Method**: POST
- **Request Body**:

```json
{
    "id": "integer",
    "rerun": "boolean"
}
```

### Get User Reports

- **Endpoint**: `/la/report/user-reports`
- **Method**: GET

### Get Room Details

- **Endpoint**: `/la/room-details`
- **Method**: GET

### Get Room Team

- **Endpoint**: `/la/room-team`
- **Method**: GET

### Get Room Reports

- **Endpoint**: `/la/room-reports`
- **Method**: GET

### Get Room Reports Count

- **Endpoint**: `/la/room-reports-count`
- **Method**: GET

### Get Room Notifications

- **Endpoint**: `/la/room-notifications`
- **Method**: GET

---

## Additional Routes

### Search Reports

- **Endpoint**: `/la/search/{query}`
- **Method**: GET
- **Parameters**:
    - `query`: Search query string

### Update Notification Seen Status

- **Endpoint**: `/la/notification/seen/{id}`
- **Method**: PATCH

### Fetch Reports from ERP

- **Endpoint**: `/la/report/fetch-erp`
- **Method**: GET

### Fetch Non-LA Users

- **Endpoint**: `/la/users/main`
- **Method**: GET

### Upload Files

- **Endpoint**: `/la/upload`
- **Method**: POST
- **Request Body**: Form Data with key `uploads`

