<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of staff records.
     */
    public function index(Request $request)
    {
        $query = Staff::query();

        // Filter by name or emp_id
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('emp_id', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by designation
        if ($request->filled('designation')) {
            $query->where('designation', 'like', '%' . $request->designation . '%');
        }

        // Filter by staff type
        if ($request->filled('staff_type')) {
            $query->where('staff_type', $request->staff_type);
        }

        $staff = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        return view('staff.index', compact('staff'));
    }

        // AJAX: Get faculty by program (optional, or just by type)
        public function facultyOnly()
        {
            $faculty = Staff::where('staff_type', 'Faculty')->get(['emp_id', 'name']);
            return response()->json($faculty);
        }

    /**
     * Show the form for creating a new staff record.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff record in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'emp_id' => 'required|unique:staff,emp_id|max:50',
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'staff_type' => 'required|in:Faculty,Non-Teaching,Support',
            'discipline' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:100',
            'official_email' => 'nullable|email|unique:staff,official_email',
            'personal_email' => 'nullable|email',
            'contact' => 'nullable|string|max:20',
            'doj' => 'required|date',
            'address' => 'nullable|string|max:500',
        ]);

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff record created successfully!');
    }

    /**
     * Show the form for editing the specified staff record.
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff record in database.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'emp_id' => 'required|unique:staff,emp_id,' . $staff->id . '|max:50',
            'name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'staff_type' => 'required|in:Faculty,Non-Teaching,Support',
            'discipline' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:100',
            'official_email' => 'nullable|email|unique:staff,official_email,' . $staff->id,
            'personal_email' => 'nullable|email',
            'contact' => 'nullable|string|max:20',
            'doj' => 'required|date',
            'address' => 'nullable|string|max:500',
        ]);

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Staff record updated successfully!');
    }

    /**
     * Show confirmation before deleting.
     */
    public function destroy(Staff $staff)
    {
        return view('staff.delete', compact('staff'));
    }

    /**
     * Actually delete the staff record.
     */
    public function confirmDelete(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff record deleted successfully!');
    }

    /**
     * Display staff report with filters.
     */
    public function report(Request $request)
    {
        $query = Staff::query();

        // Filter by staff type
        if ($request->filled('staff_type')) {
            $query->where('staff_type', $request->staff_type);
        }

        // Filter by discipline
        if ($request->filled('discipline')) {
            $query->where('discipline', $request->discipline);
        }

        // Search by name or emp_id
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('emp_id', 'like', '%' . $request->search . '%');
            });
        }

        $staff = $query->orderBy('emp_id')->paginate(15)->withQueryString();
        $staffTypes = Staff::distinct()->pluck('staff_type');
        $disciplines = Staff::distinct()->pluck('discipline')->filter();

        // Get total counts from the whole staff table
        $totalStaffCount = Staff::count();
        $facultyCount = Staff::where('staff_type', 'Faculty')->count();
        $nonTeachingCount = Staff::where('staff_type', 'Non-Teaching')->count();
        $supportCount = Staff::where('staff_type', 'Support')->count();

        return view('staff.report', compact('staff', 'staffTypes', 'disciplines', 'totalStaffCount', 'facultyCount', 'nonTeachingCount', 'supportCount'));
    }
}
