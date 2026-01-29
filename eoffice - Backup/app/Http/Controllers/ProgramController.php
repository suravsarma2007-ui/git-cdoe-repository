<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs with search.
     */
    public function index(Request $request)
    {
        $query = Program::query();

        // Search by program name, program id, or program code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('program_name', 'like', '%' . $search . '%')
                  ->orWhere('program_id', 'like', '%' . $search . '%')
                  ->orWhere('program_code', 'like', '%' . $search . '%');
            });
        }

        $programs = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created program in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_name' => 'required|string|max:100',
            'program_id' => 'required|unique:programs,program_id|max:50',
            'session_year' => 'required|string|max:20',
            'program_code' => 'required|unique:programs,program_code|max:50',
        ]);

        Program::create($validated);

        return redirect()->route('program.index')->with('success', 'Program created successfully!');
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program)
    {
        return view('program.edit', compact('program'));
    }

    /**
     * Update the specified program in database.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'program_name' => 'required|string|max:100',
            'program_id' => 'required|unique:programs,program_id,' . $program->id . '|max:50',
            'session_year' => 'required|string|max:20',
            'program_code' => 'required|unique:programs,program_code,' . $program->id . '|max:50',
        ]);

        $program->update($validated);

        return redirect()->route('program.index')->with('success', 'Program updated successfully!');
    }

    /**
     * Show confirmation before deleting.
     */
    public function destroy(Program $program)
    {
        return view('program.delete', compact('program'));
    }

    /**
     * Actually delete the program.
     */
    public function confirmDelete(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program deleted successfully!');
    }
}
