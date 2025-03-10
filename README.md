# 🚀 Task Management System

A simple Laravel-based system to manage task assignment between admins and users, with real-time statistics for user tasks.

## 📑 Project Overview

- **Admins** can create and assign tasks to **users**.  
- **Task list page** displays all created tasks (paginated).  
- **Statistics page** shows **Top 10 users** with the highest number of assigned tasks.  
- **Statistics** are automatically updated using background jobs.  

---

## ✅ Main Features

- **Task creation form** with admin & user selection.  
- **Task listing page** (paginated 10 tasks per page).  
- **Statistics page** for task counts.  
- **Background job** to update statistics.  
- **Single command** to setup & run the app.  
- **Database seeder** to generate:  
  - `100 Admins`  
  - `10,000 Users`  

---

## ⚙️ Installation & Running the App

### 1. Clone the Repository

```bash
git clone <repository-link>
cd <project-folder>
```

### 2. Configure Environment

- Create `.env` file:  

```bash
cp .env.example .env
```

- Set up your **DB connection** inside `.env`.  

### 3. One Command Setup (Migrate, Seed, Queue, Run)

```bash
php artisan app:start
```

This command will:  
- Install composer dependencies.  
- Generate application key.  
- Run migrations & seeder.  
- Prepare queue table.  
- Run queue worker.  

---

## 🧪 Running Tests

Feature tests are included to validate task creation and statistics.  

```bash
php artisan test --filter TaskTest
```  

---

## 📄 Pages Overview

### 1. **Task Creation Page**
- Fields:  
  - Admin (dropdown)  
  - Title (text)  
  - Description (textarea)  
  - Assigned User (dropdown)  

➡️ Redirect to Task List after creation.  

---

### 2. **Task List Page**
- Shows:  
  - Title  
  - Description  
  - Assigned User Name  
  - Admin Name  
- **Pagination: 10 per page**  

---

### 3. **Statistics Page**
- Shows **Top 10 users** with the highest task counts.  

---

## 🚀 Important Commands

| Command                                   | Description                                |
|------------------------------------------|--------------------------------------------|
| `php artisan app:start`                  | Full setup, migrate, seed, queue, run app  |
| `php artisan migrate:fresh --seed`       | Reset & seed database                     |
| `php artisan queue:work`                 | Run queue worker manually                 |
| `php artisan test --filter TaskTest`    | Run feature tests for tasks               |

---

## 🛠️ Technologies

- Laravel 10+  
- MySQL  
- Bootstrap 5 (UI)  
- Laravel Queue (database driver)  

---

### 🚨 Note:  
Make sure queue worker is running while creating tasks for real-time statistics update.  
