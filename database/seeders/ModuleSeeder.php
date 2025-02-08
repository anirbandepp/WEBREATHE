<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ModuleDetail;
use App\Models\ModuleHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $module = Module::create(['name' => 'Test Module', 'type' => 'Software']);

        // ModuleDetail::create([
        //     'module_id' => $module->id,
        //     'description' => 'This is a test module description',
        //     'version' => '1.0.0',
        // ]);

        // ModuleHistory::create([
        //     'module_id' => $module->id,
        //     'status' => 'created',
        //     'operation_at' => now(),
        // ]);


        Module::insert([
            [
                'name' => 'Temperature Sensor',
                'type' => 'temperature'
            ],
            [
                'name' => 'Voltage Checker',
                'type' => 'voltage'
            ],
            [
                'name' => 'Voltage Checker',
                'type' => 'voltage'
            ]
        ]);

        ModuleDetail::insert([
            [
                'module_id' => 1,
                'description' => 'Measures temperature in real-time',
                'version' => '1.2.0',
            ],
            [
                'module_id' => 3,
                'description' => 'Measures temperature in real-time',
                'version' => '1.2.0',
            ],
            [
                'module_id' => 4,
                'description' => 'Measures temperature in real-time',
                'version' => '1.2.0',
            ],
        ]);

        // *** Module History table bulk enter

        // for ($i = 0; $i < 5; $i++) {
        //     ModuleHistory::create([
        //         'module_id' => $module->id,
        //         'status' => 'active',
        //         'measured_value' => rand(20, 35),
        //         'data_items_sent' => rand(100, 500),
        //         'operating_time' => now()->subMinutes($i * 10)->format('H:i:s'),
        //         'operation_at' => now()->subMinutes($i * 10),
        //     ]);
        // }
    }
}

// php artisan db:seed --class=ModuleSeeder
