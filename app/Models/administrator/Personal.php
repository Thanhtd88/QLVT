<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personal';

    protected $guarded = [];

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id')->withTrashed();
    }
    public function department() {
        return $this->belongsTo(Department::class, 'department_id')->withTrashed();
    }
    public function project() {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
    public function transfers() {
        return $this->hasMany(TransferHistories::class, 'personal_id')->withTrashed();
    }
}
