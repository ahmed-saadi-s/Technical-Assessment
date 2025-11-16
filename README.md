# Booking Management Mini System

This project, **Technical-Assessment**, contains a mini booking management system built with Laravel.
It includes:

* **Filament Dashboard** for admin management.
* **Booking API** for creating and managing bookings.

## How to Run the Project

1. **Clone the repository**

   ```bash
   git clone https://github.com/ahmed-saadi-s/Technical-Assessment.git
   cd Technical-Assessment
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Copy the `.env` file and generate an application key**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run migrations**

   ```bash
   php artisan migrate
   ```

5. **Seed the admin user (optional seed data)**

   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```

   Default admin credentials:

   * Email: `admin@admin.com`
   * Password: `12345678`

   ### Optional Seed Data

   You can also seed some optional data for testing purposes. This includes:

   * 5 random users
   * 5 service types
   * 10 bookings linked to random service types

   To seed this data, run:

   ```bash
   php artisan db:seed --class=DatabaseSeeder
   ```

6. **Serve the application**

   ```bash
   php artisan serve
   ```

After this, the project will be running locally, and you can access the Filament Dashboard and Booking API.

---

## Tech Stack

* Laravel 11
* PHP 8.2+
* Filament PHP (Admin Panel)
* Laravel Sanctum (API Authentication)
* MySQL

## Project Overview

### Database Structure

The system contains **three main tables**:

* **Users**: Includes a `role` column with two possible values: `admin` or `staff`.
* **Service Types**: Stores the different types of services available for booking.
* **Bookings**: Stores booking records and includes a foreign key linking each booking to a service type.

### Admin Dashboard (Filament)

The Filament admin panel includes CRUD management for:

* **Users**
* **Service Types**
* **Bookings**

Authorization is handled using **Laravel Policies**:

* **Admin** users have **full access** to all resources.
* **Staff** users can only manage **Bookings** and **Service Types**.

Two **Enums** are implemented:

* `UserRole` — defines user roles.
* `BookingStatus` — defines booking status values.

Search and filter options are added to the tables for easier data navigation.

### API

The system provides **two main API endpoints**:

1. **Service Types API** – Used to retrieve the list of available service types.
   This allows the client to fetch all service types and choose the appropriate `service_type_id` when creating a booking.

2. **Booking API** – Used to create a new booking.
   This endpoint accepts the necessary booking data, validates it, and stores a new booking record in the database.

Since the task requires only two user roles (**admin** and **staff**), the API assumes that these same users are the ones who perform booking requests.

Authentication is implemented using **Laravel Sanctum** with:

* **Login** endpoint
* **Logout** endpoint

A reusable `ApiResponse` **trait** is created to unify API responses.
Inside it, two methods are overridden:

* `failedValidation`
* `failedAuthorization`

This ensures consistent formatting for validation and authorization error messages.

Form Request classes are used for **data validation**, and **API Resources** are used to format and structure the returned data cleanly.

The repository also includes a Postman collection:
**`Booking-Management-System.postman_collection.json`**
