# Staff Management System - eOffice

A complete Laravel-based staff management system with comprehensive CRUD operations, reporting, and data management capabilities.

## Features

✅ **Staff Database** - Centralized staff information management
✅ **Add Staff** - Create new staff records with complete details
✅ **Edit Staff** - Update existing staff information
✅ **Delete Staff** - Safe deletion with confirmation
✅ **Staff List** - View all staff with pagination
✅ **Staff Report** - Filtered reporting with multiple views
✅ **Printable Reports** - Generate and print staff reports
✅ **Search & Filter** - Filter by type, discipline, and search terms
✅ **Validation** - Comprehensive form validation
✅ **Responsive Design** - Works on all devices

## Database Schema

### Staff Table

| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT | Primary key |
| emp_id | VARCHAR(50) | Employee ID (unique) |
| name | VARCHAR(100) | Full name |
| designation | VARCHAR(100) | Job designation |
| staff_type | ENUM | Faculty / Non-Teaching / Support |
| discipline | VARCHAR(100) | Subject discipline (nullable) |
| subject | VARCHAR(100) | Subject taught (nullable) |
| official_email | VARCHAR | Official email (unique, nullable) |
| personal_email | VARCHAR | Personal email (nullable) |
| contact | VARCHAR(20) | Contact number (nullable) |
| doj | DATE | Date of joining |
| address | TEXT | Residential address (nullable) |
| created_at | TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | Record update time |
| deleted_at | TIMESTAMP | Soft delete timestamp |

## Project Structure

```
resources/views/staff/
├── index.blade.php      # Staff list view with pagination
├── create.blade.php     # Add new staff form
├── edit.blade.php       # Edit staff form
├── delete.blade.php     # Delete confirmation page
└── report.blade.php     # Staff report with filters

app/Models/
└── Staff.php            # Staff model with relationships

app/Http/Controllers/
└── StaffController.php  # Staff CRUD controller

database/migrations/
└── *_create_staff_table.php  # Staff table migration

routes/web.php           # Staff routes
```

## Installation & Setup

### Prerequisites
- PHP 8.1+
- Laravel 11.x
- MySQL/MariaDB

### Steps

1. **Database already set up** - Staff table created via migration ✓

2. **Access the Application:**
   - Visit: `http://127.0.0.1:8000/staff`
   - Or click "Staff" link from dashboard

## Usage Guide

### 1. View Staff List
- Navigate to **Staff Management** from the dashboard
- Click **Staff** in the navigation menu
- View all staff records with pagination (15 per page)
- See employee details at a glance

### 2. Add New Staff
1. Click **"Add New Staff"** button on the staff list
2. Fill in the form with the following required fields:
   - Employee ID (unique)
   - Full Name
   - Designation
   - Staff Type (Faculty / Non-Teaching / Support)
   - Date of Joining
3. Optional fields:
   - Discipline
   - Subject
   - Official Email
   - Personal Email
   - Contact Number
   - Address
4. Click **"Save Staff Member"**

### 3. Edit Staff
1. Click the **"Edit"** button on any staff record
2. Modify the required fields
3. Update optional information if needed
4. Click **"Update Staff Member"**

### 4. Delete Staff
1. Click the **"Delete"** button on any staff record
2. Review the staff member's details on the confirmation page
3. Click **"Yes, Delete Permanently"** to confirm
4. Record will be soft-deleted from the database

### 5. View Staff Report
1. Click **"View Report"** button on staff list
2. Apply filters (optional):
   - **Search** by name or employee ID
   - **Filter by Staff Type** (Faculty, Non-Teaching, Support)
   - **Filter by Discipline**
3. View complete staff information in report format
4. **Print** the report using the print button
5. Report includes statistics:
   - Total staff count
   - Count by staff type

## Routes

```php
GET     /staff                          # List all staff
GET     /staff/create                   # Show create form
POST    /staff                          # Store new staff
GET     /staff/{staff}/edit             # Show edit form
PUT     /staff/{staff}                  # Update staff
GET     /staff/{staff}/delete           # Show delete confirmation
DELETE  /staff/{staff}                  # Confirm delete
GET     /staff/report                   # Show staff report
```

## Controller Methods

### StaffController

- **index()** - Display paginated staff list
- **create()** - Show create form
- **store()** - Validate and save new staff
- **edit()** - Show edit form with existing data
- **update()** - Validate and update staff
- **destroy()** - Show delete confirmation
- **confirmDelete()** - Actually delete the staff record
- **report()** - Display filtered report

## Validation Rules

### Staff Fields
```php
'emp_id'          => 'required|unique:staff,emp_id|max:50'
'name'            => 'required|string|max:100'
'designation'     => 'required|string|max:100'
'staff_type'      => 'required|in:Faculty,Non-Teaching,Support'
'discipline'      => 'nullable|string|max:100'
'subject'         => 'nullable|string|max:100'
'official_email'  => 'nullable|email|unique:staff,official_email'
'personal_email'  => 'nullable|email'
'contact'         => 'nullable|string|max:20'
'doj'             => 'required|date'
'address'         => 'nullable|string|max:500'
```

## Features Explained

### Staff List View
- **Paginated Display** - Shows 15 records per page
- **Quick Actions** - Edit and Delete buttons for each record
- **Color-coded Badges** - Staff type shown with colored badges
- **Date Formatting** - DOJ displayed in readable format (dd-MMM-yyyy)
- **Email Display** - Shows official email if available

### Create/Edit Forms
- **Field Validation** - Real-time validation feedback
- **Error Messages** - Clear error messages for invalid input
- **Pre-filled Data** - Edit form pre-populates with existing data
- **Responsive Layout** - Works on desktop and mobile
- **Easy Navigation** - Cancel button to go back

### Delete Confirmation
- **Safe Deletion** - Requires confirmation before deleting
- **Member Preview** - Shows staff details before deletion
- **Clear Warning** - States the action cannot be undone
- **Soft Delete** - Records marked as deleted, not permanently removed

### Staff Report
- **Advanced Filtering** - Search, staff type, discipline filters
- **Complete Data** - Shows all staff information
- **Print Ready** - Optimized print styling
- **Statistics** - Summary cards showing staff counts
- **Export Capable** - Can print to PDF using browser

## Data Management

### Soft Deletes
- Staff records are soft-deleted (not permanently removed)
- Deleted records can be restored via database
- Maintains data integrity and audit trail

### Unique Constraints
- Employee ID must be unique
- Official Email must be unique (when provided)
- Prevents duplicate entries

### Date Handling
- Date of Joining automatically cast to date format
- Displayed consistently across application

## Tips & Best Practices

1. **Employee ID** - Use a consistent naming convention (e.g., EMP001, FAC002)
2. **Email** - Use official domain email for official_email field
3. **Phone Format** - Store contact numbers with country code if needed
4. **Address** - Include full address for administrative purposes
5. **Backups** - Regularly backup the database

## Troubleshooting

### Duplicate Employee ID Error
- Ensure the EMP ID is unique
- Check if the staff member already exists
- Edit existing record instead of creating new one

### Email Already Exists Error
- Official email must be unique across all staff
- Each staff member should have a unique email
- Use personal_email for secondary emails

### Date Validation Error
- Ensure DOJ is in valid date format (yyyy-mm-dd)
- Cannot use future dates for historical data
- Use MM/DD/YYYY format in form input

### Report Shows No Results
- Verify filters are not too restrictive
- Check that staff records exist with matching criteria
- Click "Reset" to clear all filters

## Future Enhancements

Possible additions:
- Bulk import from CSV/Excel
- Email verification
- Department management
- Leave management
- Performance tracking
- User role-based access control
- Audit logs
- Export to PDF/Excel

## Security

- ✅ CSRF protection on all forms
- ✅ SQL injection prevention (prepared statements)
- ✅ Input validation on all fields
- ✅ Authentication required for staff management
- ✅ Soft deletes for data protection

---

**Created:** December 3, 2025  
**Version:** 1.0  
**Framework:** Laravel 11.x  
**Database:** MySQL
