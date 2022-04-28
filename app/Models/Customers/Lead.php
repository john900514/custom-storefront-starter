<?php

namespace App\Models\Customers;

use App\Models\Customers\Details\LeadDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'phone', 'consent'
    ];

    public function details()
    {
        return $this->hasMany(LeadDetail::class, 'lead_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(LeadDetail::class, 'lead_id', 'id');
    }

    public function conversion()
    {
        return $this->hasOne(Conversion::class, 'lead_id', 'id');
    }

    public function conversions()
    {
        return $this->hasMany(Conversion::class, 'lead_id', 'id');
    }
}
