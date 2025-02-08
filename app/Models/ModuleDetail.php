<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleDetail extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleDetailFactory> */
    use HasFactory;

    protected $fillable = ['module_id', 'description', 'version'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
