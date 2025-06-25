<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    protected $fillable = ['asset_id', 'user_id', 'tenant_id', 'assigned_date', 'returned_date'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
