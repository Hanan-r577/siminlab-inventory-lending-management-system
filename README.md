# Inventory Lending Management System

A web-based inventory lending management system built with Laravel and MySQL.

The application helps administrators manage inventory items, record borrowing transactions, track item availability, and monitor lending history through a centralized system.

Students can view their borrowing records and monitor the status of borrowed items, while administrators manage inventory data and lending transactions.

---

## Overview

Managing inventory using spreadsheets or manual records can become difficult as the number of items and borrowing transactions grows.

This project was developed to digitize inventory tracking and borrowing management through a centralized web application.

The system focuses on inventory administration, lending records, user management, and item availability tracking.

---

## Project Scope

This project was developed as part of a Laravel bootcamp program.

My primary focus was implementing application features, understanding Laravel fundamentals, and building a complete inventory management workflow using the Laravel ecosystem.

---

## Key Features

### Authentication & Authorization

* Login & Logout
* Role-Based Access Control
* Admin Accounts
* Student Accounts

### User Management

* Create Users
* Update Users
* Delete Users
* User Listing

### Category Management

* Create Categories
* Update Categories
* Delete Categories
* Category Listing

### Inventory Management

* Create Items
* Update Items
* Delete Items
* Item Availability Tracking
* Inventory Monitoring

### Lending Management

* Borrowing Records
* Return Tracking
* Lending History
* Item Status Monitoring

### Student Portal

Students can:

* View borrowed items
* Monitor borrowing status
* Check return status

---

## System Workflow

### Borrowing Process

1. Student requests an item through an offline process
2. Administrator approves the request offline
3. Borrowing data is recorded in the application
4. Item status changes to borrowed
5. Student can view borrowed items through the system
6. Item is returned through an offline process
7. Administrator updates the borrowing status
8. Student can see the updated return status

---

## System Architecture

Laravel Application

↓

Blade Templates

↓

Business Logic Layer

↓

MySQL Database

---

## Database Design

The system uses a relational database structure designed around inventory and lending workflows.

### Core Entities

#### Users

Stores:

* User Accounts
* Authentication Data
* Role Information

Roles:

* Admin
* Student

---

#### Categories

Groups inventory items into organized categories.

Examples:

* Electronics
* Equipment
* Tools

---

#### Items

Stores:

* Item Information
* Inventory Status
* Category Relationships

---

#### Loans

Stores:

* Borrowing Records
* Return Status
* User Relationships
* Item Relationships

---

## Technical Challenges

### Inventory Tracking

Challenge:

Administrators need visibility into which items are currently borrowed and which items are available.

Solution:

Item status tracking was integrated into the lending workflow.

---

### Role Separation

Challenge:

Students and administrators require different levels of access.

Solution:

Role-based authorization was implemented to restrict system functionality according to user roles.

---

## Lessons Learned

Through this project I gained practical experience with:

* Laravel MVC Architecture
* Authentication & Authorization
* CRUD Development
* Relational Database Design
* Role-Based Access Control
* Inventory Management Workflows
* Blade Templating
* Form Validation
* Laravel Routing & Controllers

---

## Technology Stack

### Backend

* Laravel
* PHP

### Frontend

* Blade
* Bootstrap

### Database

* MySQL

---

## Screenshots

### Admin Dashboard Page
<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/a05046a7-9fd7-4257-8422-eb51142325ee" />

### CRUD Loans Page
<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/6ff621ad-0bc6-4e81-92d6-f4cbb164768c" />

### Student Dashboard Page
<img width="1920" height="1200" alt="image" src="https://github.com/user-attachments/assets/6e7ed5fd-ac54-459b-981c-48bc1152136a" />

---

## Local Development Setup

### Prerequisites

* PHP 8+
* Composer
* MySQL

### Installation

```bash
git clone https://github.com/rizqipratama25/siminlab-inventory-lending-management-system

cd siminlab-inventory-lending-management-system

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

composer run dev
```

Application:

```bash
http://127.0.0.1:8000
```

---

## Key Takeaway

This project demonstrates the implementation of authentication, role-based authorization, relational database design, and inventory lending workflows using Laravel and MySQL within a complete web application.
