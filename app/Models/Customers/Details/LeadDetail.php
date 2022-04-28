<?php

namespace App\Models\Customers\Details;

use App\Models\Customers\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['lead_id', 'field', 'value', 'misc', 'active'];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
}
