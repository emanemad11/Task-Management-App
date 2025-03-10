
# 🚀 Task Management System

A simple Laravel-based system to manage task assignments between admins and users, with real-time user task statistics.

---

## 📑 **Project Overview**

- **Admins** can create and assign tasks to **users**.  
- **Task list page** displays all created tasks (paginated).  
- **Statistics page** shows **Top 10 users** with the highest number of assigned tasks.  
- **Statistics** are **automatically updated** using background jobs.

---

## ✅ **Main Features**

- **Task creation form** (Admin, Title, Description, Assigned User).  
- **Task listing page** (Paginated 10 tasks per page).  
- **Statistics page** for top users with most tasks.  
- **Background job** to update statistics.  
- **Database seeder** to generate:
  - `100 Admins`
  - `10,000 Users`

---

## ⚙️ **Installation & Running the App**

### 1. Clone the Repository

```bash
git clone <repository-link>
cd <project-folder>
```

---

### 2. Configure Environment

- Create `.env` file:

```bash
cp .env.example .env
```

- Set up your **Database connection** inside `.env`.

---

### 3. Run Setup and Tests

#### ✅ **Run the following commands in order:**

```bash
# 1. Install dependencies
composer install

# 2. Setup the application (generate key, migrate, seed, queue worker)
php artisan app:start

# 3. Run Task feature tests
php artisan test --filter TaskTest
```

---

## 📄 **Pages Overview**

### 1. **Task Creation Page**
- Fields:
  - Admin (dropdown)
  - Title (text)
  - Description (textarea)
  - Assigned User (dropdown)
- ➡️ Redirects to task list page after creation.

---

### 2. **Task List Page**
- Shows:
  - Title
  - Description
  - Assigned User Name
  - Admin Name
- **Pagination: 10 tasks per page.**

---

### 3. **Statistics Page**
- Displays **Top 10 users** with the highest number of tasks assigned.

---

## 🚀 **Important Commands Summary**

| Command                                     | Description                                    |
|---------------------------------------------|------------------------------------------------|
| `composer install`                          | Install required dependencies                  |
| `php artisan app:start`                     | Full setup: generate key, migrate, seed, queue |
| `php artisan test --filter TaskTest`        | Run task-related feature tests                 |

---

## 🛠️ **Technologies Used**

- Laravel 10+  
- MySQL  
- Bootstrap 5 (UI)  
- Laravel Queue (Database driver)  

---

## ⚠️ **Note**

- Make sure **queue worker** is running while creating tasks to ensure real-time statistics updates.
