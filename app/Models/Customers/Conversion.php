<?php

namespace App\Models\Customers;

use App\Models\Customers\Details\ConversionDetail;
use App\Models\Customers\Details\LeadDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversion extends Model
{
    use HasFactory, SoftDeletes;

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(ConversionDetail::class, 'id', 'lead_id');
    }

    public function detail()
    {
        return $this->hasOne(ConversionDetail::class, 'id', 'lead_id');
    }
}
