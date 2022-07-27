<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilestoneArticle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }
}
