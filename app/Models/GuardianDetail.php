<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;

class GuardianDetail extends Model
{
    protected $table = 'guardian_details';
    use HasFactory;
    protected $fillable = ['applicant_id', 'name', 'relation', 'contactNo', 'email'];
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