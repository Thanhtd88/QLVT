<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit';
    protected $fillable = ['don_vi', 'slug'];
    public function personals() {
        return $this->hasMany(Personal::class, 'unit_id');
    }
}
