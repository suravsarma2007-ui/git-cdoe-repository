# eOffice - Laravel Login System

A complete Laravel authentication system with login, dashboard, header, footer, and logout functionality.

## Features

- ✅ User authentication (login/logout)
- ✅ Protected dashboard
- ✅ Responsive header with navigation
- ✅ Footer with site information
- ✅ Bootstrap 5 styling
- ✅ Session management
- ✅ Error and success messages
- ✅ CSRF protection

## Project Structure

```
eoffice/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── LoginController.php       # Authentication controller
│   └── Models/
│       └── User.php                      # User model
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php             # Master layout (header & footer)
│       ├── auth/
│       │   └── login.blade.php           # Login form
│       └── dashboard.blade.php           # Dashboard page
├── routes/
│   └── web.php                           # Web routes
├── database/
│   └── migrations/
│       └── *_create_users_table.php      # Users table
└── .env                                  # Environment configuration
```

## Installation & Setup

### 1. Prerequisites
- PHP 8.1+ (via XAMPP)
- MySQL/MariaDB (via XAMPP)
- Composer installed

### 2. Install Dependencies
```bash
cd c:\xampp\htdocs\cdoeOfficeAutomation\eoffice
composer install
```

### 3. Environment Setup
The `.env` file is already configured. Key settings:
```
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cdoe
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=database
```

### 4. Run Migrations
```bash
php artisan migrate --force
```

### 5. Create Test User (Already Done!)
A test user has been created:
- **Email:** `admin@example.com`
- **Password:** `password123`
- **Name:** Admin User

To create additional users, use Tinker:
```bash
php artisan tinker
```
Then run:
```php
App\Models\User::create([
    'name' => 'Your Name',
    'email' => 'your@email.com',
    'password' => bcrypt('yourpassword')
])
```

## Running the Application

### Option 1: Using XAMPP (Recommended)
1. Start Apache and MySQL from XAMPP Control Panel
2. Open your browser and navigate to: `http://localhost/cdoeOfficeAutomation/eoffice/public`

### Option 2: Using Laravel Development Server
```bash
cd c:\xampp\htdocs\cdoeOfficeAutomation\eoffice
php artisan serve
```
Then visit: `http://127.0.0.1:8000`

## Usage

### Login Page
- Navigate to `/login` or click "Login" in the navigation
- Enter email: `admin@example.com`
- Enter password: `password123`
- Click "Sign In"

### Dashboard
- After successful login, you'll see the dashboard
- Displays user information and quick actions
- Header shows welcome message with logout button

### Logout
- Click the "Logout" button in the top-right corner
- Session will be destroyed and you'll be redirected to login

## Routes

| Method | Route | Controller | Notes |
|--------|-------|-----------|-------|
| GET | `/login` | LoginController@show | Show login form (guest only) |
| POST | `/login` | LoginController@store | Process login (guest only) |
| GET | `/` | LoginController@dashboard | Show dashboard (auth only) |
| POST | `/logout` | LoginController@logout | Process logout (auth only) |

## File Descriptions

### LoginController.php
- `show()` - Display login form
- `store()` - Handle login submission with validation
- `dashboard()` - Show protected dashboard
- `logout()` - Handle user logout

### layouts/app.blade.php
- Master template for all views
- Contains header with navigation
- Flash messages (success/error alerts)
- Bootstrap 5 styling
- Footer with copyright info

### auth/login.blade.php
- Login form with email and password fields
- Error messages display
- Extends master layout
- Form validation feedback

### dashboard.blade.php
- Welcome message
- User profile information
- Quick action cards
- User details list
- Only accessible to authenticated users

## Security Features

✅ **CSRF Protection** - All forms protected with `@csrf`
✅ **Password Hashing** - Passwords hashed with bcrypt
✅ **Session Management** - Secure session handling
✅ **Route Protection** - Middleware guards routes
✅ **Input Validation** - Server-side form validation
✅ **Auth Guard** - Built-in Laravel authentication

## Customization

### Change Database Connection
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=
```

### Add More Users
Use Laravel Tinker or a registration page (can be added)

### Modify Header/Footer
Edit `resources/views/layouts/app.blade.php`

### Customize Dashboard
Edit `resources/views/dashboard.blade.php`

## Troubleshooting

### Page not found (404)
- Ensure you're accessing `http://localhost/cdoeOfficeAutomation/eoffice/public`
- Check that Laravel development server is running if using `php artisan serve`

### Database connection error
- Verify XAMPP MySQL is running
- Check DB credentials in `.env`
- Run `php artisan migrate`

### Login not working
- Verify user exists in database: `php artisan tinker` then `App\Models\User::all()`
- Check password is correct
- Clear cache: `php artisan cache:clear`

### Session not persisting
- Ensure `SESSION_DRIVER=database` in `.env`
- Run migrations to create sessions table

## Next Steps

Want to extend this? I can add:
- User registration page
- Password reset functionality
- User profile edit page
- Admin panel
- Email verification
- Two-factor authentication

---

**Created:** December 3, 2025  
**Laravel Version:** 11.x  
**PHP Version:** 8.1+
