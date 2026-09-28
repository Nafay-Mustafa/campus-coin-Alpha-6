# Campus Coin

**Campus Coin** is a Laravel-based student budgeting and expense tracking web application.

It helps students manage their money by recording income and expenses, creating budgets, viewing reports, and getting simple spending insights.

---

## Main Features

### Student Features
- Student registration and login
- Student profile and financial information
- Add income and expenses
- Edit and delete transactions
- Create personal categories
- Set monthly budgets
- View current balance
- View spending by category
- View six-month income/expense trends
- Get saving tips and monthly insights
- Save useful tips and insights as bookmarks
- Filter financial reports
- Import transactions from CSV
- Export transactions to CSV
- Print reports or save them as PDF
- Dark mode
- Responsive design for mobile and desktop
- Application sitemap

### Admin Features
- Separate administrator login
- Admin dashboard
- View basic user and transaction statistics
- Add default income/expense categories
- Remove default categories

---

## Technologies Used

- **Backend:** PHP 8.3+
- **Framework:** Laravel 13
- **Authentication:** Laravel Jetstream / Fortify
- **Live Components:** Livewire
- **Database:** MySQL
- **Frontend:** Blade, HTML5, CSS3, JavaScript
- **CSS:** Tailwind CSS
- **Build Tool:** Vite
- **Package Managers:** Composer and npm

---

## Requirements

Before running the project, make sure these are installed:

1. PHP 8.3 or newer
2. Composer
3. Node.js and npm
4. MySQL
5. A modern web browser

### Check your installations

```bash
php -v
composer -V
node -v
npm -v
```

---

# Installation

Follow these steps in order.

## 1. Open the project folder

Open Command Prompt or PowerShell inside the **Campus-coin** folder.

Example:

```bash
cd path/to/Campus-coin
```

---

## 2. Install PHP dependencies

```bash
composer install
```

---

## 3. Create the environment file

Copy `.env.example` and create a new file named:

```text
.env
```

On Windows Command Prompt, you can use:

```bash
copy .env.example .env
```

---

## 4. Configure the database

Open the `.env` file.

The project can use MySQL. Update these values according to your MySQL setup:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campus_coin
DB_USERNAME=root
DB_PASSWORD=
```

### Important

First create the database in MySQL/phpMyAdmin:

```text
campus_coin
```

If your MySQL username or password is different, change it in `.env`.

---

## 5. Generate the Laravel application key

```bash
php artisan key:generate
```

---

## 6. Create database tables and demo data

```bash
php artisan migrate --seed
```

This creates the required database tables and also adds demo users and default categories.

---

## 7. Create the storage link

```bash
php artisan storage:link
```

---

## 8. Install frontend dependencies

```bash
npm install
```

---

## 9. Build the frontend

```bash
npm run build
```

---

## 10. Start Laravel

```bash
php artisan serve
```

Laravel will normally show a URL similar to:

```text
http://127.0.0.1:8000
```

Open that URL in your browser.

---

#  Demo Login Accounts

## Student

```text
Email: student@campuscoin.test
Password: Student@12345
```

## Administrator

```text
Email: admin@campuscoin.test
Password: Admin@12345
```

The administrator login is available at:

```text
/admin/login
```

> **Security:** These are demo credentials. Change them before using the application on a public server.

---

# Recommended Testing

After starting the project, test it in this order:

1. Open the home page.
2. Register a new student account.
3. Login.
4. Add an income transaction.
5. Add an expense transaction.
6. Edit a transaction.
7. Delete a transaction.
8. Create a personal category.
9. Create a monthly budget.
10. Check the dashboard balance and spending information.
11. Open the six-month trend.
12. Open the Insights page.
13. Save/bookmark a useful insight or tip.
14. Open Reports.
15. Apply report filters.
16. Import transactions using CSV.
17. Export transactions as CSV.
18. Print a report or save it as PDF.
19. Try dark mode.
20. Check the website on a mobile-sized screen.
21. Open the Sitemap.
22. Logout.
23. Login through the Administrator Login page.
24. Check the admin dashboard and category management.

---

# How Campus Coin Works

The basic flow is:

```text
Register / Login
       ↓
    Dashboard
       ↓
Add Income / Expense
       ↓
 Select Category
       ↓
Save Transaction
       ↓
Dashboard & Reports Update
       ↓
Budget Comparison
       ↓
Saving Tips / Insights
```

Students can use their recorded transactions to understand where their money is going.

---

# Reports

The Reports section allows students to:

- Filter transactions
- Filter by date
- Filter by category
- Filter by transaction type
- Import transactions using CSV
- Export transactions as CSV
- Print the report
- Save the report as PDF using the browser's **Print → Save as PDF** option

---

# Smart Insights

Campus Coin includes simple local rules for:

- Category suggestions
- Spending insights
- Saving tips
- Budget warnings

These features are **advisory** and use the transaction data stored in the application.

The project does **not** require an external AI API.

---

# Database

The main database entities include:

- Users
- Categories
- Transactions
- Budgets
- Insights
- Bookmarks

Basic relationships:

```text
User
 ├── Transactions
 ├── Personal Categories
 ├── Budgets
 ├── Insights
 └── Bookmarks

Category
 ├── Transactions
 └── Budgets
```

---

# Resetting the Database

For a completely fresh test database, you can run:

```bash
php artisan migrate:fresh --seed
```

**Warning:** This deletes the existing database tables and data before creating them again.

Only use this when you are okay with losing the current database data.

---

# Useful Laravel Commands

### Clear configuration/cache

```bash
php artisan optimize:clear
```

### Run migrations

```bash
php artisan migrate
```

### Start the application

```bash
php artisan serve
```

### Build frontend files

```bash
npm run build
```

### Development frontend server

```bash
npm run dev
```

---

# Security Notes

- Do not share your real `.env` file.
- Do not commit database passwords or API keys.
- Change demo passwords before public deployment.
- Use HTTPS when deploying publicly.
- The application does not process real bank accounts or real payments.

---

# Documentation

More detailed project information is available in:

```text
docs/PROJECT_REPORT.md
docs/FEATURE_CHECKLIST.md
ReadMe.doc
```

`PROJECT_REPORT.md` contains the project problem definition, architecture, security information, feature list, test data, installation instructions and submission notes.

---

# Project Information

**Project:** Campus Coin  
**Theme:** NextGen BudgetBee  
**Type:** Student Budgeting & Expense Tracker  
**Framework:** Laravel  
**Database:** MySQL  
**Authentication:** Jetstream / Fortify  
**Frontend:** Blade, Tailwind CSS, JavaScript  
**Build Tool:** Vite

---

## Important Note

This README is intended to make the project easy to install and understand. For academic submission requirements, screenshots, detailed architecture and the complete feature checklist, also review the files inside the `docs` folder.
