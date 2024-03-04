
---

# MOCK CBA API Documentation

## Introduction

This document provides details about the available endpoints in the API and their functionalities.

## Endpoints

### 1. Create Account

- **URL**: `/create-account`
- **Method**: `POST`
- **Description**: Creates a new user account along with an associated bank account.
- **Request Body**:
  ```json
  {
      "firstname": "John",
      "middlename": "Doe",
      "lastname": "Smith",
      "email": "john@example.com",
      "address": "123 Main St",
      "city": "Anytown",
      "state": "State",
      "postal_code": "12345",
      "country": "Country",
      "date_of_birth": "1990-01-01",
      "phone_number": "123-456-7890",
      "nin": "1234567891",
      "bvn": "1234567801",
      "account_type": "current" 
  }
  ```
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `message`: A brief message describing the result of the operation.
    - `user`: Details of the created user.
    - `account`: Details of the created bank account.

### 2. Account Operations

#### Debit Account

- **URL**: `/account/debit`
- **Method**: `POST`
- **Description**: Allows debiting an amount from the specified bank account.
- **Request Body**:
  ```json
  {
      "account_number": "1234567890",
      "amount": 500
  }
  ```
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `message`: A brief message describing the result of the operation.
    - `account`: Details of the updated bank account.

#### Credit Account

- **URL**: `/account/credit`
- **Method**: `POST`
- **Description**: Allows crediting an amount to the specified bank account.
- **Request Body**:
  ```json
  {
      "account_number": "1234567890",
      "amount": 500
  }
  ```
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `message`: A brief message describing the result of the operation.
    - `account`: Details of the updated bank account.

#### Restrict Account Operations

- **URL**: `/account/restrict`
- **Method**: `POST`
- **Description**: Restricts both debit and credit operations for the specified account.
- **Request Body**:
  ```json
  {
      "account_number": "1234567890"
  }
  ```
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `message`: A brief message confirming the restriction placed on the account.

#### Unrestrict Account Operations

- **URL**: `/account/unrestrict`
- **Method**: `POST`
- **Description**: Removes restrictions on both debit and credit operations for the specified account.
- **Request Body**:
  ```json
  {
      "account_number": "1234567890"
  }
  ```
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `message`: A brief message confirming the removal of restrictions from the account.

### 3. Transactions

#### Get Transactions for Account

- **URL**: `/account/transactions`
- **Method**: `GET`
- **Description**: Fetches all transactions associated with the specified bank account.
- **Query Parameters**:
    - `account_number`: The account number for which transactions are to be fetched.
- **Response**:
    - `status`: Indicates whether the request was successful (`true`) or not (`false`).
    - `transactions`: List of transactions associated with the account.

---
