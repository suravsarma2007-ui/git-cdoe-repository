# Program Management System - Documentation

## Overview

Complete program management module for eOffice with full CRUD operations, search functionality, and integration with dashboard and navigation.

## Features

✅ **Program Database** - Store and manage academic programs
✅ **Add Programs** - Create new programs with unique IDs and codes
✅ **Edit Programs** - Update program information
✅ **Delete Programs** - Safe deletion with confirmation
✅ **Program List** - View all programs with pagination (15 per page)
✅ **Search Functionality** - Search by program name, ID, or code
✅ **Dashboard Integration** - Quick access from main dashboard
✅ **Navigation Link** - Easy access from top navigation bar

## Database Schema

### Programs Table

| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT | Primary key (auto-increment) |
| program_name | VARCHAR(255) | Name of the program |
| program_id | VARCHAR(50) | Unique program identifier |
| session_year | VARCHAR(20) | Academic session year |
| program_code | VARCHAR(50) | Unique program code |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |
| deleted_at | TIMESTAMP | Soft delete timestamp |

## Files Created

### 1. Migration
**File:** `database/migrations/2025_12_03_000002_create_programs_table.php`
- Creates `programs` table
- Sets up unique constraints on `program_id` and `program_code`
- Includes soft delete support

### 2. Model
**File:** `app/Models/Program.php`
- Eloquent model for programs
- Soft delete enabled
- Fillable properties defined

### 3. Controller
**File:** `app/Http/Controllers/ProgramController.php`
- **index()** - List programs with search
- **create()** - Show create form
- **store()** - Save new program
- **edit()** - Show edit form
- **update()** - Save updates
- **destroy()** - Show delete confirmation
- **confirmDelete()** - Actually delete the program

### 4. Routes
**File:** `routes/web.php` (Updated)
- 7 routes under `/program` prefix
- All protected by `auth` middleware

### 5. Views

| View | Purpose |
|------|---------|
| `program/index.blade.php` | List programs with search box |
| `program/create.blade.php` | Create new program form |
| `program/edit.blade.php` | Edit existing program form |
| `program/delete.blade.php` | Delete confirmation page |

### 6. Updates
- `layouts/app.blade.php` - Added Program link to navigation
- `dashboard.blade.php` - Added Program card with link

## Field Specifications

### Program Name
- **Type:** TEXT
- **Required:** YES
- **Max Length:** 100 characters
- **Example:** "Bachelor of Computer Applications"

### Program ID
- **Type:** VARCHAR(50)
- **Required:** YES
- **Unique:** YES (Database constraint)
- **Example:** "PROG001", "BA2024"

### Session Year
- **Type:** VARCHAR(20)
- **Required:** YES
- **Max Length:** 20 characters
- **Example:** "2024-25", "2025"

### Program Code
- **Type:** VARCHAR(50)
- **Required:** YES
- **Unique:** YES (Database constraint)
- **Example:** "BCA", "MBA", "BA"

## Validation Rules

### Create/Update
```php
'program_name' => 'required|string|max:100'
'program_id' => 'required|unique:programs|max:50'
'session_year' => 'required|string|max:20'
'program_code' => 'required|unique:programs|max:50'
```

### Edit Updates
- Allows current record's values (ignores self in unique check)
- Same validation rules as create

## How to Use

### Access Program Module

**From Dashboard:**
1. Click "Go to Programs" on the Program Management card
   OR
2. Click "Program" in the top navigation bar
   OR
3. Direct URL: `http://127.0.0.1:8000/program`

### View All Programs
1. Go to program list page
2. See all programs in paginated table (15 per page)
3. Each row shows:
   - Program name
   - Program ID (blue badge)
   - Session year
   - Program code (gray badge)
   - Creation date
   - Edit/Delete action buttons

### Search Programs
1. On program list page, locate search box at top
2. Enter search term (searches program name, ID, or code)
3. Click "Search" button
4. Results filtered and displayed below
5. Click "Reset" to clear search and see all programs

### Add New Program
1. Click "Add New Program" button on list page
2. Fill in the form:
   - **Program Name** (required) - Name of the program
   - **Program ID** (required, unique) - Unique identifier
   - **Session Year** (required) - Academic year
   - **Program Code** (required, unique) - Program code
3. Click "Save Program"
4. Redirected to list with success message

### Edit Program
1. Click "Edit" button on any program row
2. Form pre-populated with current data
3. Update any field
4. Click "Update Program"
5. Changes saved and list displayed

### Delete Program
1. Click "Delete" button on any program row
2. Confirmation page shows:
   - Program details
   - Warning message
3. Click "Yes, Delete Permanently" to confirm
   OR "Cancel" to go back
4. Program soft-deleted and list displayed

## Routes Reference

```
GET    /program              → List programs with search
GET    /program/create       → Show create form
POST   /program              → Save new program
GET    /program/{id}/edit    → Show edit form
PUT    /program/{id}         → Save updates
GET    /program/{id}/delete  → Show delete confirmation
DELETE /program/{id}         → Confirm deletion
```

## Search Functionality

Search works across three fields:
1. **Program Name** - Searches program name
2. **Program ID** - Searches unique ID
3. **Program Code** - Searches program code

Example searches:
- "BCA" - Finds programs with BCA in name/code
- "2024" - Finds programs from 2024
- "PROG" - Finds programs with PROG in ID

## Pagination

- 15 programs per page
- Bootstrap pagination links at bottom
- Shows current page and total pages
- Maintains search query in pagination links

## Soft Delete

- Records are not permanently removed
- Can be restored from database if needed
- Deleted records don't appear in normal queries
- `deleted_at` field stores deletion timestamp

## Error Handling

### Duplicate Program ID
- Shows error: "The program id has already been taken"
- Form retains other values
- User can correct ID and resubmit

### Duplicate Program Code
- Shows error: "The program code has already been taken"
- Form retains other values
- User can correct code and resubmit

### Required Fields Missing
- Shows error for each empty required field
- Form retains entered values
- User can complete and resubmit

## UI Features

✅ **Responsive Design** - Works on mobile, tablet, desktop
✅ **Bootstrap 5** - Modern UI with consistent styling
✅ **Badges** - Color-coded badges for IDs and codes
✅ **Hover Effects** - Table rows highlight on hover
✅ **Flash Messages** - Success/error messages after actions
✅ **Error Display** - Clear validation error messages
✅ **Empty States** - Helpful messages when no programs exist
✅ **Action Buttons** - Clear, prominent buttons for actions

## Security

✅ **CSRF Protection** - All forms use @csrf token
✅ **SQL Injection Prevention** - Prepared statements via Eloquent
✅ **Input Validation** - Server-side validation
✅ **Authentication Required** - All routes require login
✅ **Unique Constraints** - Database level uniqueness

## Integration

### Dashboard
- Program card added to dashboard
- Shows direct link to program management
- Easy one-click access

### Navigation
- "Program" link added to top navigation bar
- Visible to all authenticated users
- Quick access from any page

### Related Models
- Can be extended to link with Staff (Faculty can teach in programs)
- Can be linked to Courses
- Can connect to Enrollments

## Sample Data

Try creating a program:
- **Program Name:** Bachelor of Computer Applications
- **Program ID:** BCA2024
- **Session Year:** 2024-25
- **Program Code:** BCA

## Troubleshooting

### Duplicate ID Error
- Ensure Program ID is unique
- Check if program already exists
- Edit existing record instead of creating new

### Cannot Access Program Page
- Ensure you're logged in
- Check URL: `http://127.0.0.1:8000/program`
- Clear browser cache

### Search Not Working
- Ensure search query is entered
- Try different search terms
- Use part of name, ID, or code

### Form Fields Not Saving
- Check for validation errors (displayed in red)
- Ensure all required fields are filled
- Correct any error messages and resubmit

## Future Enhancements

- Bulk import programs from CSV/Excel
- Export programs list
- Department/Faculty linking
- Program status (Active/Inactive)
- Program description field
- Course linking to programs
- Student enrollment tracking
- Program statistics dashboard

## Database Queries

### Find program by ID
```php
$program = Program::where('program_id', 'BCA2024')->first();
```

### Find program by code
```php
$program = Program::where('program_code', 'BCA')->first();
```

### List all programs for a year
```php
$programs = Program::where('session_year', '2024-25')->get();
```

### Search programs
```php
$programs = Program::where('program_name', 'like', '%BCA%')
            ->orWhere('program_code', 'like', '%BCA%')
            ->get();
```

---

**Status:** ✅ Complete and Ready to Use
**Created:** December 3, 2025
**Framework:** Laravel 11.x
**Database:** MySQL/MariaDB
