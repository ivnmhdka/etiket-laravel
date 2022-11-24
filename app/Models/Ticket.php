<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'status',
        'price',
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'ticket_id', 'id');
    }
}
