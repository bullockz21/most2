<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class BorrowedBook extends Model
{
    protected $connection = 'library_api_db';

    protected $table = 'borrowed_books';
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];
    protected $dates = ['borrowed_at', 'returned_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book() : BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
