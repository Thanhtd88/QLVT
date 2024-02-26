<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehicle';

    protected $guarded = [];

    public function personal() {
        return $this->belongsTo(Personal::class, 'personal_id')->withTrashed();
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id')->withTrashed();
    }

    public function transfers() {
        return $this->hasMany(TransferHistories::class, 'vehicle_id')->withTrashed();
    }
}
