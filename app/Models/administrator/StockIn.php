<?php

namespace App\Models\administrator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockIn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stock_in';

    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id')->withTrashed();
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id')->withTrashed();
    }


}
