<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Course extends Model
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
        'available_from',
        'available_to',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'course_id', 'id');
    }

    public function getAllCourses(): LengthAwarePaginator
    {
        return $this->paginate(15);
    }

    public function searchCourses(string $searchString = null): LengthAwarePaginator
    {
        return $searchString == null
            ? $this->getAllCourses()
            : $this->where('name', 'like', '%' . $searchString . '%')->paginate(15);
    }
}
