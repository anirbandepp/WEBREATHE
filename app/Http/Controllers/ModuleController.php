<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleDetail;
use App\Models\ModuleHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $modules = Module::with(['details', 'histories'])->orderBy('id', 'desc')->get();
            return view('frontend.pages.modules.index')->with(['modules' => $modules]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(Request $request)
    {
        return view('frontend.pages.modules.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'description' => 'nullable|string',
                'version' => 'nullable|string|max:50',
            ]);

            // Create module
            $module = Module::create([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            // Store module details
            ModuleDetail::create([
                'module_id' => $module->id,
                'description' => $request->description,
                'version' => $request->version,
            ]);

            return redirect()->route('modules.index')->with('success', 'Module registered successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // *** Show a specific module with its details and histories
    public function show($id)
    {
        $module = Module::with(['details', 'histories'])->findOrFail($id);
        return view('frontend.pages.modules.edit')->with(['module' => $module]);
    }

    // Update an existing module
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $module = Module::findOrFail($id);

            $module->update([
                'name' => $request->name,
            ]);

            $moduledetail = ModuleDetail::where('module_id', $id)->first();

            $moduledetail->update([
                'description' => $request->description,
            ]);

            return redirect()->route('modules.index')->with('success', 'Module updated successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // *** Delete a module and its associated details and histories
    public function destroy($id)
    {
        try {
            $module = Module::findOrFail($id);
            $module->details()->delete();
            $module->histories()->delete();
            $module->delete();

            return redirect()->route('modules.index')->with('success', 'Module deleted successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function status(Request $request)
    {
        try {
            $modules = Module::with(['histories' => function ($query) {
                $query->latest()->limit(5);
            }])->orderBy('id', 'desc')->get();

            return view('frontend.pages.modules.status')->with([
                'modules' => $modules
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function sinleModuleStatus(Request $request, $id)
    {
        try {
            $modules = Module::where('id', $id)->with(['histories' => function ($query) {
                $query->latest()->limit(5);
            }])->get();

            return view('frontend.pages.modules.single-status.status')->with(
                ['modules' => $modules]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
