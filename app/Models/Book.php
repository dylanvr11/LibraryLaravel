<?php

namespace App\Models;

use App\Models\Lend;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'image',
        'stock',
        'description'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function Lends()
    {
        return $this->hasMany(Lend::class, 'book_id', 'id');
    }
}
