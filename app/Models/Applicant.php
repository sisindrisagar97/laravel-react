<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\GuardianDetail;
use App\Models\ProgramDetail;
use App\Models\ReferralDetail;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'contactNo', 'nationality', 'contactNo', 'email', 'address', 'state', 'city', 'pin','referraltype','dob',
    ];
    public function setContactNoAttribute($value)
    {
        $this->attributes['mobile'] = $value;
    }
    public function getContactNoAttribute()
    {
        return $this->attributes['mobile'];
    }
    public function setpinAttribute($value)
    {
        $this->attributes['pincode'] = $value;
    }
    public function getpinAttribute()
    {
        return $this->attributes['pincode'];
    }

    public function guardianDetail()
    {
        return $this->hasOne(GuardianDetail::class, 'applicant_id');
    }
    public function programDetail()
    {
        return $this->hasOne(ProgramDetail::class, 'applicant_id');
    }
    public function referralDetail()
    {
        return $this->hasOne(ReferralDetail::class, 'applicant_id');
    }
}
?>