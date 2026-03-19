<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    /**
     * Get the user that owns the group.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The contacts that belong to the group.
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_group')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include groups for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the contacts count for the group.
     */
    public function getContactsCountAttribute()
    {
        return $this->contacts()->count();
    }
}
