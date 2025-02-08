<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\ModuleHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateModuleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generate-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate module status updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            // Generate random measured values (simulate sensor readings)
            $measuredValue = rand(15, 40);
            $dataItemsSent = rand(50, 500);

            // Simulate malfunction conditions (e.g., 10% chance of failure)
            $status = 'active';
            if (rand(1, 10) == 1) {
                $status = 'error';
            } elseif ($measuredValue < 20 || $measuredValue > 35) {
                $status = 'warning';
            }

            Log::info(['measuredValue' => $measuredValue, 'dataItemsSent' => $dataItemsSent]);


            // Save new module history
            ModuleHistory::create([
                'module_id' => $module->id,
                'measured_value' => $measuredValue,
                'data_items_sent' => $dataItemsSent,
                'operating_time' => now(),
                'status' => $status,
                'operation_at' => now(),
            ]);

            $this->info("Updated status for module: {$module->name} - Status: {$status}");
        }
    }
}
