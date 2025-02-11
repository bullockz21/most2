<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use App\Models\BorrowedBook;


class Book extends Model
{
    protected $connection = 'library_api_db';
    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'description',
        'total_copies',
        'available_copies',
    ];

    public function borrowedBooks(): hasMany
    {
        return $this->hasMany(BorrowedBook::class, 'book_id', 'id');
    }
}
