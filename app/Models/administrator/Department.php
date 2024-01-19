<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'department';
    protected $fillable = ['phong_ban', 'slug'];
    public function personals() {
        return $this->hasMany(Personal::class, 'department_id');
    }
}
