<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function leadOrganization()
    {
        return $this->hasOne(LeadOrganization::class);
    }

    public function leadAssignment()
    {
        return $this->hasOne(LeadAssignment::class);
    }

    public function leadRequirement()
    {
        return $this->hasOne(LeadRequirement::class);
    }

    public function leadVisitedProperty()
    {
        return $this->hasOne(LeadVistedProperty::class);
    }
}
