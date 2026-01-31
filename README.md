# User Management (PHP + MySQL)

A simple PHP/MySQL user management app with an admin login, dashboard listing users, and CRUD operations for users.

## Features

- Admin authentication (login/logout)
- Dashboard with users list
- Add user
- Edit user
- Delete user
- Change admin password

## Tech Stack

- PHP 8.x
- MySQL / MariaDB
- Apache (XAMPP recommended)

## Project Structure

```
user-managment/
  index.php
  dashboard.php
  database.sql
  assets/
    css/style.css
    js/main.js
  auth/
    login.php
    logout.php
    change_password.php
  config/
    config.php
  users/
    add_user.php
    edit_user.php
    delete_user.php
```

## Setup (XAMPP on Windows)

1. **Copy project into htdocs**
   - Place the folder at: `C:\xampp\htdocs\user-managment`

2. **Start services**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**

3. **Create the database and tables**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Import the SQL file: `database.sql`
     - It creates the database `user_management` and the tables `admins` and `users`.

4. **Configure DB connection**
   - Update credentials if needed in `config/config.php`:
     - Host: `localhost`
     - User: `root`
     - Password: `` (empty by default in XAMPP)
     - Database: `user_management`

## Run

- Open: `http://localhost/user-managment/`
  - `index.php` will redirect you to the login page if you are not logged in.

## Default Admin

The default admin is inserted by `database.sql`:

- **Username:** `admin`
- **Password:** `admin123`

## Pages

- Login: `auth/login.php`
- Dashboard: `dashboard.php`
- Add user: `users/add_user.php`
- Edit user: `users/edit_user.php?id=1`
- Change password: `auth/change_password.php`

## Notes

- Passwords are stored using `password_hash()` (bcrypt). If you change the admin password, the app will continue to work with hashed passwords.
- This project is intended for learning/demo purposes.
