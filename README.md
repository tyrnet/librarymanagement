# 📚 Library Management System

## 📝 Description / Overview
The **Library Management System** is a web-based application built with the Laravel framework.  
It allows librarians and administrators to efficiently manage books, categories, and users.  
The system provides CRUD (Create, Read, Update, Delete) functionality for library resources, ensuring an organized and user-friendly interface for maintaining library records.

## 🎯 Objectives
- To apply Laravel framework fundamentals in developing a functional web system.
- To practice using MVC (Model-View-Controller) architecture for better code organization.
- To implement CRUD operations and database relationships.
- To enhance skills in building responsive and dynamic web applications.

## ⚙️ Features / Functionality
- **Book Management:** Add, edit, delete, and view books.
- **Category Management:** Organize books into categories.
- **User Management:** Register, authenticate, and assign user roles.
- **Dashboard:** View library statistics and system overview.
- **Database Integration:** Uses SQLite/MySQL for storing records.
- **Authentication System:** Secure login and registration using Laravel’s Auth scaffolding.

## 💻 Installation Instructions
1. **Clone or extract** the project files.
   ```bash
   git clone https://github.com/tyrnet/librarymanagement.git
. **Navigate to the project folder**
   ```bash
   cd librarymanagement
   ```

3. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

4. **Copy the environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Set up database**
   - Update your `.env` file with your database credentials.
   - Run migrations:
     ```bash
     php artisan migrate
     ```

7. **Run the server**
   ```bash
   php artisan serve
   ```
   The app will be available at `http://127.0.0.1:8000`.
