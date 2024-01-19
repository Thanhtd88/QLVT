<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferHistories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transfer_histories';
    protected $guarded = [];
    
    public function vihicle(){
        return $this->belongsTo(Vihicle::class, 'vihicle_id')->withTrashed();
    }

    public function personal() {
        return $this->belongsTo(Personal::class, 'personal_id')->withTrashed();
    }
}
