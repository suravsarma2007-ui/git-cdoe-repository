# Staff Management System - Architecture & Flow

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                         eOffice Application                  │
└─────────────────────────────────────────────────────────────┘
                             │
                             ▼
            ┌────────────────────────────────┐
            │     Authentication Guard       │
            │   (Login Required for Staff)   │
            └────────────────────────────────┘
                             │
                ┌────────────┼────────────┐
                ▼            ▼            ▼
           ┌─────────┐  ┌─────────┐  ┌─────────┐
           │  Staff  │  │ Request │  │Response │
           │ Routes  │  │ Handler │  │  View   │
           └─────────┘  └─────────┘  └─────────┘
                │            │            │
                └────────────┼────────────┘
                             ▼
                  ┌──────────────────────┐
                  │  StaffController     │
                  │  (8 Methods)         │
                  └──────────────────────┘
                             │
              ┌──────────────┼──────────────┐
              ▼              ▼              ▼
         ┌────────┐    ┌───────────┐   ┌─────────┐
         │ Staff  │    │ Validation│   │Database │
         │ Model  │    │   Rules   │   │ Query   │
         └────────┘    └───────────┘   └─────────┘
              │              │             │
              └──────────────┼─────────────┘
                             ▼
                  ┌──────────────────────┐
                  │   Staff Table        │
                  │  (MySQL Database)    │
                  └──────────────────────┘
```

## Request Flow Diagram

### Adding a New Staff Member

```
┌─────────────┐
│ User clicks │
│"Add New"    │
└──────┬──────┘
       │
       ▼
┌──────────────────────┐
│ GET /staff/create    │
│ StaffController@     │
│ create()             │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ Return create form   │
│ (Blade template)     │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ User fills form &    │
│ clicks Save          │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ POST /staff          │
│ StaffController@     │
│ store()              │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ Validation Rules     │
│ Applied              │
└──────┬───────────────┘
       │
    ┌──┴──┐
    │     │
    ▼     ▼
  ✗Pass ✓Fail
   │      │
   │      ▼
   │  ┌──────────────┐
   │  │ Show errors  │
   │  │ in form      │
   │  └──────────────┘
   │
   ▼
┌──────────────────────┐
│ Staff::create()      │
│ Save to database     │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ Redirect with        │
│ success message      │
│ to staff list        │
└──────┬───────────────┘
       │
       ▼
┌──────────────────────┐
│ Display staff list   │
│ with new record      │
└──────────────────────┘
```

## Edit Flow

```
┌──────────────────────────────────────────┐
│ User views staff list and clicks "Edit"  │
└──────────────────────┬───────────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ GET /staff/{id}/edit   │
              │ StaffController@edit() │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ Fetch staff record     │
              │ from database          │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ Render edit form       │
              │ with pre-filled data   │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ User updates fields    │
              │ clicks Update          │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ PUT /staff/{id}        │
              │ StaffController@       │
              │ update()               │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ Validate input         │
              │ (same rules as create) │
              └────────┬───────────────┘
                       │
                    ┌──┴──┐
                    │     │
                    ▼     ▼
                  ✓Pass ✗Fail
                   │      │
                   │      └─► Show errors
                   │
                   ▼
              ┌────────────────────────┐
              │ $staff->update()       │
              │ Save to database       │
              └────────┬───────────────┘
                       │
                       ▼
              ┌────────────────────────┐
              │ Redirect to list       │
              │ with success message   │
              └────────────────────────┘
```

## Delete Flow

```
┌────────────────────────────────────────┐
│ User views list and clicks "Delete"    │
└──────────┬─────────────────────────────┘
           │
           ▼
    ┌────────────────────────┐
    │ GET /staff/{id}/delete │
    │ StaffController@       │
    │ destroy()              │
    └────────┬───────────────┘
             │
             ▼
    ┌────────────────────────┐
    │ Show confirmation page │
    │ with staff details     │
    └────────┬───────────────┘
             │
             ▼
    ┌────────────────────────┐
    │ User clicks            │
    │"Yes, Delete Permanently"
    └────────┬───────────────┘
             │
             ▼
    ┌────────────────────────┐
    │ DELETE /staff/{id}     │
    │ StaffController@       │
    │ confirmDelete()         │
    └────────┬───────────────┘
             │
             ▼
    ┌────────────────────────┐
    │ $staff->delete()       │
    │ (Soft delete)          │
    │ Sets deleted_at time   │
    └────────┬───────────────┘
             │
             ▼
    ┌────────────────────────┐
    │ Redirect to list       │
    │ with success message   │
    └────────────────────────┘
```

## Report Flow

```
┌──────────────────────────────────┐
│ User clicks "View Report"        │
└────────────┬─────────────────────┘
             │
             ▼
    ┌────────────────────────────┐
    │ GET /staff/report          │
    │ StaffController@report()   │
    └────────┬───────────────────┘
             │
             ▼
    ┌────────────────────────────┐
    │ Display filter form with:  │
    │ - Search field             │
    │ - Staff Type dropdown      │
    │ - Discipline dropdown      │
    └────────┬───────────────────┘
             │
    ┌────────┴──────────────────┐
    │ User applies filters and  │
    │ submits form              │
    └────────┬──────────────────┘
             │
             ▼
    ┌────────────────────────────┐
    │ GET /staff/report?filters  │
    │ Build query with filters   │
    └────────┬───────────────────┘
             │
             ▼
    ┌────────────────────────────┐
    │ Execute filtered query on  │
    │ staff table                │
    └────────┬───────────────────┘
             │
             ▼
    ┌────────────────────────────┐
    │ Display complete staff     │
    │ table with all columns     │
    └────────┬───────────────────┘
             │
    ┌────────┴──────────────────┐
    │        │                  │
    ▼        ▼                  ▼
 View    Print Report      Export Option
```

## Database Schema Diagram

```
┌──────────────────────────────────────────────────┐
│                    STAFF TABLE                    │
├──────────────────────────────────────────────────┤
│ id (INT, PK, AUTO)                              │
│ emp_id (VARCHAR(50), UNIQUE)                    │
│ name (VARCHAR(100))                             │
│ designation (VARCHAR(100))                      │
│ staff_type (ENUM: Faculty|Non-Teaching|Support) │
│ discipline (VARCHAR(100), NULLABLE)             │
│ subject (VARCHAR(100), NULLABLE)                │
│ official_email (VARCHAR, UNIQUE, NULLABLE)      │
│ personal_email (VARCHAR, NULLABLE)              │
│ contact (VARCHAR(20), NULLABLE)                 │
│ doj (DATE)                                      │
│ address (TEXT, NULLABLE)                        │
│ created_at (TIMESTAMP)                          │
│ updated_at (TIMESTAMP)                          │
│ deleted_at (TIMESTAMP, NULLABLE)                │
└──────────────────────────────────────────────────┘
```

## File Structure

```
eoffice/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── StaffController.php .............. CRUD Operations
│   │
│   └── Models/
│       └── Staff.php ........................... Data Model
│
├── database/
│   └── migrations/
│       └── 2025_12_03_000001_create_staff_table.php
│
├── resources/
│   └── views/
│       └── staff/
│           ├── index.blade.php ................ List View
│           ├── create.blade.php ............... Create Form
│           ├── edit.blade.php ................. Edit Form
│           ├── delete.blade.php ............... Delete Confirmation
│           └── report.blade.php ............... Report & Filters
│
├── routes/
│   └── web.php ............................... Route Definitions
│
└── documentation/
    ├── STAFF_MANAGEMENT.md ................... Complete Guide
    ├── STAFF_QUICK_GUIDE.md .................. Quick Reference
    └── STAFF_IMPLEMENTATION.md ............... Implementation Details
```

## Control Flow Summary

```
User Action → Route → Controller Method → Model → Database → View → Response
                         │
                         ├─ Validate Input
                         ├─ Process Data
                         ├─ Query Database
                         ├─ Flash Message
                         └─ Render Response
```

## Validation Pipeline

```
Form Submission
    │
    ▼
┌─────────────────────────────────┐
│ Request::validate() called      │
└────────┬────────────────────────┘
         │
    ┌────┴─────┐
    │          │
    ▼          ▼
 PASS      FAIL
    │          │
    │          └─► Store errors in $errors
    │          └─► Redirect back with input
    │          └─► Display form with messages
    │
    ▼
 Process & Save
    │
    ▼
 Redirect with Success Message
```

---

This architecture ensures:
✅ **Separation of Concerns** - Controller, Model, View clearly separated
✅ **Validation** - Input validated before database operations
✅ **Error Handling** - Clear error messages for users
✅ **Data Integrity** - Unique constraints prevent duplicates
✅ **User Feedback** - Success/error messages shown
✅ **Security** - CSRF protection, input sanitization
