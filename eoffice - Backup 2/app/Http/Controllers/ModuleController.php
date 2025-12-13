<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\module as Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderByDesc('slno')->paginate(15);
        return view('module.index', compact('modules'));
    }

    public function create()
    {
        return view('module.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'moduleNo' => 'required|integer|min:1|unique:modules,moduleNo',
        ]);

        Module::create($validated);
        return redirect()->route('module.index')->with('success', 'Module created successfully.');
    }

    public function edit(Module $module)
    {
        return view('module.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'moduleNo' => 'required|integer|min:1|unique:modules,moduleNo,' . $module->getKey() . ',slno',
        ]);

        $module->update($validated);
        return redirect()->route('module.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('module.index')->with('success', 'Module deleted successfully.');
    }
}
