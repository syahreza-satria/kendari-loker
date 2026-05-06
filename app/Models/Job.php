<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'category_id',
        'type_id',
        'title',
        'slug',
        'description',
        'requirements',
        'location_area',
        'salary_min',
        'salary_max',
        'is_active',
        'poster',
        'link',
        'closing_date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'type_id');
    }
}
