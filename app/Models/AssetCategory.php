<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tenant_id',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
