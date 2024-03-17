<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Factories\HasFactory};

class Project extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'user_id',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeNameLike($query, $name): void
    {
        $query->when($name, function ($q) use ($name) {
            return $q->where('name', 'like', "%{$name}%");
        });
    }
}
