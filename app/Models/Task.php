<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'available_from',
        'available_to',
        'max_points',
        'course_id',
    ];

    /*
    * course category will be added later
    *
    */
    public function getAllTasksWithCourseAndCategory(): LengthAwarePaginator
    {
        //return $this->with('course', 'category')->paginate(15);
        return $this->with('course')->paginate(15);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function searchTasks(string $searchString = null): LengthAwarePaginator
    {
        return $searchString == null
            ? $this->getAllTasksWithCourseAndCategory()
            : $this->where(function ($q) use ($searchString) {
                $q->orWhere('name', 'like', '%' . $searchString . '%')
                    ->orWhere('max_points', 'like', '%' . $searchString . '%')
                    ->orWhere('available_from', 'like', '%' . $searchString . '%')
                    ->orWhere('available_to', 'like', '%' . $searchString . '%')
                    ->orWhereHas('course', function ($query) use ($searchString) {
                        $query->where('name', 'like', '%' . $searchString . '%');
                    })
                    /*->orWhereHas('category', function ($query) use ($searchString) {
                        $query->where('name', 'like', '%' . $searchString . '%');
                    })*/;
            })
                ->with('course'/*, 'category'*/)
                ->paginate(15);
    }
}
