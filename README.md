# School Result System — Laravel + MySQL

Laravel conversion of the original Node.js School Result System. The UI is preserved from the source project while the server/database layer is being migrated to Laravel and MySQL.

## Requirements
- PHP 8.2+
- Composer
- MySQL 8+

## Setup
1. Copy `.env.example` to `.env`.
2. Configure MySQL in `.env`.
3. Run `composer install`.
4. Run `php artisan key:generate`.
5. Run `php artisan migrate --seed`.
6. Run `php artisan serve`.


## Feature coverage
Admin login, classes, subjects, exams, individual result entry/edit/publish, bulk Excel preview/import, public result search, reports, CSV/Excel export, backup, user management and audit endpoints are included in the Laravel port. The original frontend pages and styling are preserved in `resources/views` and `public`.