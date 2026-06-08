
<div align="center">

<img src="https://lisbontuktukexplorer.com/logo/logo.ico" alt="Lisbon Tuk Tuk Explorer Logo" width="80"/>

# Lisbon Tuk Tuk Explorer

A full-stack Laravel-based tourism platform for exploring Lisbon through guided Tuk Tuk tours. The system enables tourists to browse, book, and securely pay for tours online while providing administrators with a comprehensive dashboard to manage tours, bookings, customers, and business operations.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-635BFF?style=for-the-badge&logo=stripe&logoColor=white)

</div>

---

## 📖 Overview

Lisbon Tuk Tuk Explorer is a modern tourism management platform built to simplify the process of discovering and booking Tuk Tuk tours in Lisbon. Tourists can explore available tours, view detailed information, make reservations, and securely complete payments through Stripe.

The platform includes a powerful administrative backend that enables efficient management of tours, bookings, customers, and business operations.

---

## ✨ Features

### 👤 Tourist Features

- Browse available Tuk Tuk tours
- View detailed tour information and pricing
- Online tour booking system
- Secure Stripe payment integration
- Booking history and tracking
- User profile management
- Fully responsive design
- Fast and intuitive user experience

### 🛠️ Admin Features

- Secure admin dashboard
- Tour management (Create, Update, Delete)
- Booking management
- Customer management
- Booking status updates
- Tour scheduling
- Revenue monitoring
- Business analytics and reporting

---

## 🚀 Technology Stack

### Backend

- Laravel
- PHP 8+
- MySQL
- Eloquent ORM

### Frontend

- Blade Templates
- Tailwind CSS
- Alpine.js
- JavaScript
- Vite

### Payment Processing

- Stripe Payment Gateway

### Development Tools

- Laravel Authentication
- Laravel Validation
- Laravel Migrations
- Laravel Seeders
- Git & GitHub

---

## 🎯 Key Functionalities

### 🛺 Tour Booking System

- Browse available tours
- View detailed tour information and pricing
- Reserve tours online
- Manage booking records
- Track booking status

### 💳 Payment System

- Secure online payments via Stripe
- Payment verification and processing
- Booking confirmation after successful payment

### 📊 Administration Panel

- Manage tours and schedules
- View and update bookings
- Manage customer accounts
- Monitor platform activity
- Track revenue and booking statistics

---

## ⚙️ Installation

### Clone Repository

```bash
git clone https://github.com/pabonsaha/tuktuk_explorer.git
cd tuktuk_explorer
````

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

Update your `.env` file:

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

### Seed Database (Optional)

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

### Start Server

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

---

## 📂 Project Structure

```text
app/
├── Http/
├── Models/
├── Services/

database/
├── migrations/
├── seeders/

resources/
├── views/
├── css/
├── js/

routes/
├── web.php
├── api.php

public/
```

---

## 🔒 Security Features

* Authentication & Authorization
* CSRF Protection
* Server-side Validation
* Password Hashing
* Secure Stripe Payment Processing
* Role-Based Access Control

---

## 🔮 Future Enhancements

* Multi-language Support
* Tour Guide Profiles
* Customer Reviews & Ratings
* Email Notifications
* Advanced Tour Filtering
* Mobile Application Support
* Real-time Booking Notifications
* Interactive Tour Maps

---

## 🌍 Live Website

https://lisbontuktukexplorer.com

---

## 👨‍💻 Author

**Pabon Saha**

Full-Stack Web Developer specializing in Laravel, Tailwind CSS, Alpine.js, and modern web applications.

* GitHub: https://github.com/pabonsaha

---

## 📄 License

This project is developed for educational and commercial purposes.

```
```
