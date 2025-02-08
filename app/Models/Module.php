<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function details()
    {
        return $this->hasOne(ModuleDetail::class);
    }

    public function histories()
    {
        return $this->hasMany(ModuleHistory::class);
    }
}
