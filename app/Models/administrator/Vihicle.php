<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vihicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vihicle';

    protected $guarded = [];

    // public function personals() {
    //     return $this->hasMany(Personal::class, 'personal_id');
    // }

    public function personal() {
        return $this->belongsTo(Personal::class, 'personal_id')->withTrashed();
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id')->withTrashed();
    }

    public function transfers() {
        return $this->hasMany(TransferHistories::class, 'vihicle_id')->withTrashed();
    }
}
