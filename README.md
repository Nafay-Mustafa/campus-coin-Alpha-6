# Campus Coin

Campus Coin is a Laravel-based student budgeting and expense tracker.

## Quick start
```text
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Open the Laravel local URL.

### Demo accounts
- Student: student@campuscoin.test / Student@12345
- Admin: admin@campuscoin.test / Admin@12345

Change demo passwords before deployment.

## Important
Configure MySQL in `.env`. Do not commit real credentials or API keys.

For the complete feature list and evaluator instructions, read `docs/PROJECT_REPORT.md` and `ReadMe.doc`.
