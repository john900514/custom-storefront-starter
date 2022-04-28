<?php

namespace App\Models\Customers\Details;

use App\Models\Customers\Conversion;
use App\Models\Customers\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversionDetail extends Model
{
    use HasFactory, SoftDeletes;

    public function conversion()
    {
        return $this->belongsTo(Conversion::class, 'conversion_id', 'id');
    }


}
