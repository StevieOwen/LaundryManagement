<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slip extends Model
{
    /** @use HasFactory<\Database\Factories\SlipFactory> */
    use HasFactory;
    protected $fillable=['id','order_id','slip_number','slip_type','generated_by'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'generated_by');
    }
}
