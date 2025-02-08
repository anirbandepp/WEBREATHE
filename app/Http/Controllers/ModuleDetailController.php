<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleDetail;
use Illuminate\Http\Request;

class ModuleDetailController extends Controller
{
    // Fetch details for a specific module
    public function index($moduleId)
    {
        $details = ModuleDetail::with('module')->where('module_id', $moduleId)->get();
        return view('frontend.pages.module_details.index')->with(['details' => $details]);
    }

    // Store a new module detail
    public function store(Request $request, $moduleId)
    {
        $request->validate([
            'detail_name' => 'required|string',
            'value' => 'required|string',
        ]);

        $module = Module::findOrFail($moduleId);
        $detail = $module->details()->create([
            'detail_name' => $request->detail_name,
            'value' => $request->value,
        ]);

        return response()->json($detail, 201);
    }

    // Update an existing module detail
    public function update(Request $request, $moduleId, $detailId)
    {
        $request->validate([
            'detail_name' => 'required|string',
            'value' => 'required|string',
        ]);

        $detail = ModuleDetail::where('module_id', $moduleId)->findOrFail($detailId);
        $detail->update([
            'detail_name' => $request->detail_name,
            'value' => $request->value,
        ]);

        return response()->json($detail);
    }

    // Delete a module detail
    public function destroy($moduleId, $detailId)
    {
        $detail = ModuleDetail::where('module_id', $moduleId)->findOrFail($detailId);
        $detail->delete();

        return response()->json(['message' => 'Detail deleted successfully.']);
    }
}
