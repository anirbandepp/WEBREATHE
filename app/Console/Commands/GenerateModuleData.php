<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\ModuleHistory;
use Illuminate\Console\Command;

class GenerateModuleData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate module data and history';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            // Randomly determine if the module is warning or working again
            $status = $module->histories()->latest()->first()->status ?? 'active';
            if ($status == 'active' && rand(1, 10) == 1) {
                $status = 'warning'; // 10% chance of failure
            } elseif ($status == 'inactive' && rand(1, 5) == 1) {
                $status = 'active'; // 20% chance of recovery
            } elseif ($status == 'warning' && rand(1, 5) == 1) {
                $status = 'active'; // 20% chance of recovery
            } elseif ($status == 'broken' && rand(1, 5) == 1) {
                $status = 'active'; // 20% chance of recovery
            }

            // Assign random measurement type
            $measurementTypes = ['temperature', 'speed', 'voltage'];
            $measurementType = $measurementTypes[array_rand($measurementTypes)];

            // Generate appropriate random values
            $measuredValue = match ($measurementType) {
                'temperature' => rand(15, 40),  // Celsius
                'speed' => rand(10, 120),  // km/h
                'voltage' => rand(200, 240),  // Volts
            };

            // If broken, set measured value to null
            if ($status == 'broken') {
                $measuredValue = null;
            }

            // Store in the database
            ModuleHistory::create([
                'module_id' => $module->id,
                'measurement_type' => $measurementType,
                'measured_value' => $measuredValue,
                'status' => $status,
                'operation_at' => now(),
            ]);

            $this->info("Generated data for {$module->name}: {$measurementType} - {$measuredValue} - Status: {$status}");
        }
    }
}
