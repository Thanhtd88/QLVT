<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'protection';
    protected $guarded = [];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class, 'warehouse_id')->withTrashed();
    }

    public function personal() {
        return $this->belongsTo(Personal::class, 'personal_id')->withTrashed();
    }
}
