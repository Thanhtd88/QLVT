<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'maintenance';

    protected $guarded = [];

    public function vihicle() {
        return $this->belongsTo(Vihicle::class, 'vihicle_id')->withTrashed();
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class, 'warehouse_id')->withTrashed();
    }
}
