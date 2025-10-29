# 📚 LibraryHub

LibraryHub is a web-based **Library Management System** built with **Laravel**.  
It allows users to browse available books, borrow and return them, while administrators can manage books, categories, and borrowings efficiently.

---

## 🚀 Features

### 👤 User
- View available books
- Borrow and return books  
- View personal borrowing history

### 🛠️ Admin
- Manage CRUD books 
- Approve or reject borrow requests  
- Mark books as returned  

---

## 🧰 Tech Stack

- **Framework:** Laravel 10+
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Authentication:** Laravel Breeze (if installed)
- **Frontend:** Blade Templates + Tailwind CSS

---

## 🖥️ Local Setup Guide

Follow these steps to run **LibraryHub** on your local machine.

---

### 1️⃣ Clone the Repository

```
git clone https://github.com/dannielefendi/LibraryHub.git
cd LibraryHub
```

### 2️⃣ Install Dependencies

Make sure **Composer** is installed
```
composer install
```

If you’re using npm for frontend assets (optional):
```
npm install && npm run dev
```


### 3️⃣ Configure Environment
Copy the example environment file and generate the application key:

```
cp .env.example .env
php artisan key:generate
```
Then edit `.env` file to match your local setup:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blabla
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Database Migrations
Make sure MySQL is running, then run:
```
php artisan migrate --seed
```
This command will create the required tables and optionally seed initial data.

### 5️⃣ Serve the Application
Start the Laravel development server:
```
php artisan serve
```
The app will be available at 👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)
