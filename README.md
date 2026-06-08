# Lisbon Tour Guide Hiring System

A full-stack Laravel web application developed for Lisbon's tourism industry, allowing tourists to discover, book, and pay for guided tours online while providing administrators with a powerful management dashboard for overseeing tours, bookings, and customers.

## Overview

The Lisbon Tour Guide Hiring System is a comprehensive tourism platform designed to streamline tour reservations in Lisbon. Visitors can browse available tours, view detailed information, securely book experiences, and complete payments online. Administrators can efficiently manage tours, bookings, customers, and platform operations through a dedicated backend panel.

## Features

### Tourist Features

* Detailed Tour Information
* Online Tour Booking
* Secure Stripe Payment Integration
* Booking History & Tracking
* User Profile Management
* Fully Responsive Design

### Admin Features

* Secure Admin Dashboard
* Tour Management (Create, Update, Delete)
* Booking Management
* Customer Management
* Booking Status Updates
* Tour Scheduling
* Revenue and Booking Monitoring

## Technology Stack

### Backend

* Laravel
* PHP 8+
* MySQL
* Eloquent ORM

### Frontend

* Blade Templates
* Tailwind CSS
* Alpine.js
* JavaScript
* Vite

### Payment Processing

* Stripe Payment Gateway

### Development Tools

* Laravel Migrations
* Laravel Seeders
* Laravel Authentication
* Laravel Validation
* Git & GitHub

## Key Functionalities

### Tour Booking System

* Browse available tours
* View tour details and pricing
* Reserve tours online
* Manage booking records

### Payment System

* Secure online payments through Stripe
* Payment verification and processing
* Booking confirmation after successful payment

### Administration Panel

* Manage tours and schedules
* View and update bookings
* Manage customers
* Monitor platform activity

## Installation

### Clone Repository

```bash
[git clone https://github.com/pabonsaha/tuktuk_explorer.git]
cd tuktuk_explorer
```

### Install Dependencies

```bash
composer install
npm install
```

### Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Configure database and Stripe credentials in the `.env` file:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
```

### Run Migrations

```bash
php artisan migrate
```

(Optional)

```bash
php artisan db:seed
```

### Build Frontend Assets

```bash
npm run build
```

For development:

```bash
npm run dev
```

### Start Application

```bash
php artisan serve
```

## Security Features

* Secure Authentication & Authorization
* CSRF Protection
* Server-side Validation
* Password Hashing
* Stripe Secure Payment Processing
* Role-Based Access Control

## Future Enhancements

* Multi-language Support
* Tour Guide Profiles
* Customer Reviews & Ratings
* Email Notifications
* Advanced Tour Filtering
* Mobile Application Integration

## Author

Developed as a full-stack tourism management platform for Lisbon's tourism industry using Laravel, Tailwind CSS, Alpine.js, and Stripe Payment Gateway.
