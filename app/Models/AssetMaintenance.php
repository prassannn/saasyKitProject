<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetMaintenance extends Model
{
    protected $fillable = ['asset_id','tenant_id','issue_description', 'reported_at', 'resolved_at'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
