<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id'];

    public function courseName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Course::find($attributes['course_id'])?->name
        );
    }

    public function startedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)
        );
    }

    public function completedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)
        );
    }

    public function courseAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => Course::find($attributes['course_id'])?->amount
        );
    }
}
