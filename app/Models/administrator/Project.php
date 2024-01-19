<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project';
    protected $fillable = ['du_an', 'slug'];
    public function personals() {
        return $this->hasMany(Personal::class, 'project_id');
    }
}
