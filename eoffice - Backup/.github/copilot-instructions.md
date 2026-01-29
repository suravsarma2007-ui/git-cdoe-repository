# Copilot Instructions for eOffice Laravel Codebase

## Project Overview
- **Framework:** Laravel 11.x (PHP 8.1+)
- **Modules:** Staff Management, Program Management, User Authentication
- **UI:** Bootstrap 5, responsive, consistent across modules
- **Database:** MySQL/MariaDB, soft deletes, unique constraints

## Architecture & Key Patterns
- **MVC Structure:**
  - Controllers in `app/Http/Controllers/`
  - Models in `app/Models/`
  - Views in `resources/views/`
- **Routes:**
  - Defined in `routes/web.php`
  - All major modules (staff, program) use RESTful routes and are protected by `auth` middleware
- **Navigation:**
  - Main links: Dashboard | Staff | Program | Welcome | Logout
  - Dashboard and navigation updated for each module
- **Data Flow:**
  - User actions → Route → Controller → Model → Database → View → Response
  - Validation via `Request::validate()` in controllers
  - Flash messages for success/error feedback

## Developer Workflows
- **Install dependencies:**
  - `composer install` (PHP), `npm install` (if using frontend assets)
- **Run migrations:**
  - `php artisan migrate --force`
- **Serve app:**
  - `php artisan serve` (or use XAMPP Apache at `/public`)
- **Create users:**
  - Use `php artisan tinker` and Eloquent model creation
- **Testing:**
  - No custom test suite documented; use `php artisan test` for default

## Module Conventions
- **Staff Management:**
  - CRUD via `StaffController`, model: `Staff.php`, views in `views/staff/`
  - Soft deletes, unique `emp_id` and `official_email`
  - Advanced report view with filters and print/export
- **Program Management:**
  - CRUD via `ProgramController`, model: `Program.php`, views in `views/program/`
  - Soft deletes, unique `program_id` and `program_code`
  - Search box in list view, paginated (15 per page)
- **Validation:**
  - All forms use server-side validation, clear error messages, and retain input on error
  - Example: `program_id` and `program_code` must be unique (see migration and controller)
- **Security:**
  - All forms use `@csrf` Blade directive
  - All management routes require authentication
  - Input validation and database constraints enforced

## Integration & Extensibility
- **Adding new modules:**
  - Follow existing MVC and navigation patterns
  - Update dashboard and navigation for new features
- **Extending models:**
  - Use Eloquent relationships for linking (e.g., staff to programs)
- **UI Consistency:**
  - Use Bootstrap 5 classes and layout from `layouts/app.blade.php`

## Key Files & References
- `LARAVEL_SETUP.md` – Setup and environment details
- `PROGRAM_MANAGEMENT.md`, `STAFF_MANAGEMENT.md` – Full module docs
- `PROGRAM_QUICK_GUIDE.md`, `STAFF_QUICK_GUIDE.md` – Quick reference
- `PROGRAM_IMPLEMENTATION.md`, `STAFF_ARCHITECTURE.md` – Implementation and architecture

## Examples
- **Add Program:** Use `/program/create`, fill all fields, unique constraints enforced
- **Search Staff:** Use `/staff/report` for advanced filtering and printing
- **Soft Delete:** Deletions mark `deleted_at`, records can be restored from DB

---
For more, see the above documentation files. Follow Laravel best practices unless project docs specify otherwise.
