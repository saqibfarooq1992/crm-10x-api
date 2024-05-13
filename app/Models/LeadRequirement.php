<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadRequirement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
