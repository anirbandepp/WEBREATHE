<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleHistoryFactory> */
    use HasFactory;

    protected $fillable = ['module_id', 'status', 'operation_at', 'measured_value', 'data_items_sent', 'operating_time'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
