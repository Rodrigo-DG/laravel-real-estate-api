<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'property_id',
        'visit_date',
        'comments',
        'status',
    ];

    // Relación con el cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con la propiedad
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
