<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tenant_id',
        'asset_category_id',
        'serial_no',
        'condition',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
