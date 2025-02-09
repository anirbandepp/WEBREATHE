<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleHistory;
use Illuminate\Http\Request;

class ModuleHistoryController extends Controller
{
    // Fetch histories for a specific module
    public function index($moduleId)
    {
        $histories = ModuleHistory::where('module_id', $moduleId)->orderBy('id', 'desc')->paginate(25);

        return view('frontend.pages.module_histories.index')->with(['histories' => $histories]);
    }

    // Store a new module history
    public function store(Request $request, $moduleId)
    {
        $request->validate([
            'event' => 'required|string',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $module = Module::findOrFail($moduleId);
        $history = $module->histories()->create([
            'event' => $request->event,
            'event_date' => $request->event_date,
            'description' => $request->description,
        ]);

        return response()->json($history, 201);
    }

    // Update an existing module history
    public function update(Request $request, $moduleId, $historyId)
    {
        $request->validate([
            'event' => 'required|string',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $history = ModuleHistory::where('module_id', $moduleId)->findOrFail($historyId);
        $history->update([
            'event' => $request->event,
            'event_date' => $request->event_date,
            'description' => $request->description,
        ]);

        return response()->json($history);
    }

    // Delete a module history
    public function destroy($moduleId, $historyId)
    {
        $history = ModuleHistory::where('module_id', $moduleId)->findOrFail($historyId);
        $history->delete();

        return response()->json(['message' => 'History deleted successfully.']);
    }
}
