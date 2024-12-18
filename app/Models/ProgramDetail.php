<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;

class ProgramDetail extends Model
{
    use HasFactory;
    protected $fillable = ['applicant_id', 'program', 'specialization', 'mode'];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
?>