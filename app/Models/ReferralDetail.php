<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;

class ReferralDetail extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'name', 'contactNo', 'program', 'batchYear'];
    public function setContactNoAttribute($value)
    {
        $this->attributes['mobile'] = $value;
    }

    public function getContactNoAttribute()
    {
        return $this->attributes['mobile'];
    }
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
?>