<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'project_code'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_code', 'code');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function scopeByTeamMembers($query, $members = [])
    {
        $query->when($members, function ($q) use ($members) {
            return $q->whereHas('users', function ($query) use ($members) {
                return $query->whereIn('users.id', $members);
            });
        });
    }

    public function scopeByProject($query, $project = null)
    {
        $query->when($project, function ($q) use ($project) {
            return $q->where('project_code', $project);
        });
    }

    public function scopeByStatus($query, $status = null)
    {
        $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
}
