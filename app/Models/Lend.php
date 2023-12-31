<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lend extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_user_id', //prestamista bibliotecario
        'customer_user_id', //prestador (cliente)
        'book_id',
        'date_out',
        'date_in',
        'status',
    ];

    public function Book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function Ower()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function Customer()
    {
        return $this->belongsTo(User::class, 'customer_user_id', 'id');
    }
}
