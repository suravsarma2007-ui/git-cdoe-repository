<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{

    public function index()
    {
        $sessions = AcademicSession::orderByDesc('created_at')->paginate(15);
        return view('academic_session.index', compact('sessions'));
    }

    public function create()
    {
        return view('academic_session.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'session_id'   => 'required|string|max:50|unique:academic_sessions,session_id',
            'session_name' => 'required|string|max:150',
            'session_year' => 'required|string|max:50',
        ]);

        AcademicSession::create($validated);
        return redirect()->route('academic_session.index')->with('success', 'Session created successfully.');
    }

    public function edit(AcademicSession $academic_session)
    {
        return view('academic_session.edit', compact('academic_session'));
    }

    public function update(Request $request, AcademicSession $academic_session)
    {
        $validated = $request->validate([
            'session_id'   => 'required|string|max:50|unique:academic_sessions,session_id,' . $academic_session->id,
            'session_name' => 'required|string|max:150',
            'session_year' => 'required|string|max:50',
        ]);

        $academic_session->update($validated);
        return redirect()->route('academic_session.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(AcademicSession $academic_session)
    {
        $academic_session->delete();
        return redirect()->route('academic_session.index')->with('success', 'Session deleted successfully.');
    }
}
