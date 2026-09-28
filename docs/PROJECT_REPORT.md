# Campus Coin — Project Report

**Project:** Campus Coin  
**Theme:** NextGen BudgetBee  
**Category:** End-to-End Web Solutions  
**Framework:** PHP Laravel  
**Database:** MySQL  
**Frontend:** Blade, HTML5, CSS3, JavaScript  
**Authentication:** Laravel Fortify / Jetstream

> **Submission note:** Review the screenshots, student details, institute details and AI-tool acknowledgement before final submission.

## 1. Cover Page
Campus Coin is a student-first budgeting and expense tracking web application. It helps students record income and expenses, organise categories, set budgets and understand their spending patterns.

## 2. Problem Definition
Students receive money from different sources such as allowance, part-time work, scholarships and gifts. Their expenses are spread across food, transport, hostel/rent, academics, subscriptions and entertainment. Campus Coin provides one simple place to record these transactions and review spending habits.

## 3. Design Specifications

### Main modules
- Student registration and secure login
- Student profile and financial baseline
- Income and expense transactions
- Default and personal categories
- Monthly category budgets
- Dashboard and six-month trend view
- Saving tips generated from recorded spending
- Monthly spending insight
- Bookmarks for useful tips and insights
- Reports with date/category/type filters
- CSV transaction import and CSV report export
- Browser print flow for saving reports as PDF
- Administrator login and control panel
- Sitemap
- Dark-mode and responsive layout

### ER relationship summary
- One User has many Transactions.
- One User has many personal Categories.
- One Category has many Transactions.
- One User has many Budgets.
- One Category can be referenced by many Budgets.
- One User has many Insights.
- One User has many Bookmarks.

### Activity flow
Student → Register/Login → Dashboard → Add Income/Expense → Select Category → Save Transaction → Dashboard totals/reports update → Budget comparison → Saving tip/insight.

### Report flow
Student → Reports → Select date range/category/type → Review transactions → Export CSV or Print/Save as PDF.

## 4. System Architecture

### Overall architecture
**Presentation layer:** Blade views, HTML5, CSS3 and JavaScript provide responsive pages, forms, dashboard widgets and reports.

**Application layer:** Laravel routes and controllers validate requests, apply business rules, authenticate users, calculate summaries and manage transactions/budgets/categories.

**Data layer:** MySQL stores users, categories, transactions, budgets, insights and bookmarks.

**External/API interaction:** The current core implementation does not require an external AI API or banking API. The insight/category suggestion logic is local and advisory. No real bank account or payment processing is performed.

### Architecture diagram
Browser → Laravel Routes → Controllers/Validation → Eloquent Models → MySQL Database

## 5. Security Features
- Laravel authentication and session management
- CSRF protection on POST/PUT/DELETE forms
- Password hashing through Laravel
- User-owned transaction/category/budget authorization checks
- Admin-only checks for control-panel actions
- Input validation for financial forms
- No real payment or bank credentials are processed
- Password reset and email verification routes are provided by Laravel Fortify
- Optional two-factor authentication is available through the installed Jetstream/Fortify stack

## 6. Wireframes / Mockups
The working application provides:
1. Public landing page
2. Student registration/login
3. Dashboard
4. Budget management
5. Reports and CSV import/export
6. Monthly insights
7. Saved tips/insights
8. Administrator login
9. Administrator dashboard
10. Sitemap

Use screenshots of these pages in the final printed report.

## 7. Test Data

### Administrator
Email: `admin@campuscoin.test`  
Password: `Admin@12345`

### Demo student
Email: `student@campuscoin.test`  
Password: `Student@12345`

**Security note:** Change these demo passwords before any public deployment.

### Sample student data
- Monthly allowance: PKR 25,000
- Monthly saving goal: PKR 5,000
- Sample income: PKR 25,000
- Sample Food expense: PKR 1,800
- Sample Transport expense: PKR 900

## 8. Project Installation Instructions
1. Install PHP 8.3+, Composer, Node.js/npm and MySQL.
2. Open the project folder in Command Prompt/PowerShell.
3. Run `composer install`.
4. Create `.env` from `.env.example`.
5. Set the MySQL database name, username and password in `.env`.
6. Run `php artisan key:generate`.
7. Run `php artisan migrate --seed`.
8. Run `php artisan storage:link`.
9. Run `npm install`.
10. Run `npm run build`.
11. Run `php artisan serve`.
12. Open the local URL shown by Laravel, normally `http://127.0.0.1:8000`.
13. Use the demo credentials above, or register a new student.
14. For administrator testing open `/admin/login`.

**Important:** `migrate:fresh --seed` deletes existing database tables/data. Use it only for a fresh test database.

## 9. Test Checklist
- Register a student.
- Login/logout.
- Reset password flow.
- Add income.
- Add expense.
- Edit a transaction.
- Delete a transaction.
- Create a personal category.
- Set a budget.
- Check budget progress.
- Open six-month dashboard trend.
- Open monthly insight.
- Bookmark a tip.
- Open saved bookmarks.
- Filter reports.
- Import a CSV file.
- Export CSV.
- Print report and choose Save as PDF in the browser.
- Toggle dark mode.
- Open sitemap.
- Login as administrator.
- Add/remove a default category.

## 10. AI Tool Acknowledgement
AI assistance was used as a development support tool for debugging, implementation guidance and checking requirements. The application structure, project decisions and final review should be understood by the developer before submission. No external banking or payment AI integration is claimed by this report.

## 11. Limitations
- The application does not connect to real bank accounts.
- It does not process real monetary payments.
- The current smart categorisation/insight logic is local and advisory rather than a hosted machine-learning service.
- PDF export uses the browser's Print/Save as PDF workflow.
- Email delivery requires valid SMTP configuration in `.env`.
