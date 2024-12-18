<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\GuardianDetail;
use App\Models\ProgramDetail;
use App\Models\ReferralDetail;

class ApplicantController extends Controller
{
    public function saveapplicant(Request $request)
    {
        // \Log::info('Request Data: ' . json_encode($request->all())); 
        $validatedData = $request->validate([
            'personalDetails.name' => 'required|string|max:255',
            'personalDetails.dob' => 'required|date|before:today',
            'personalDetails.nationality' => 'required|string|max:100',
            'personalDetails.contactNo' => 'required|digits_between:10,15',
            'personalDetails.email' => 'required|email',
            'personalDetails.address' => 'required|string|max:500',
            'personalDetails.state' => 'required|string|max:100',
            'personalDetails.city' => 'required|string|max:100',
            'personalDetails.pin' => 'required|digits:6',
    
            'guardianDetails.name' => 'required|string|max:255',
            'guardianDetails.relation' => 'required|string|max:50',
            'guardianDetails.contactNo' => 'required|digits_between:10,15',
            'guardianDetails.email' => 'nullable|email',
    
            'programDetails.program' => 'required|string|max:100',
            'programDetails.specialization' => 'required|string|max:100',
            'programDetails.mode' => 'required|in:Online,Offline',
    
            'referralDetails.name' => 'nullable|string|max:255',
            'referralDetails.contactNo' => 'nullable|digits_between:10,15',
            'referralDetails.program' => 'nullable|string|max:100',
            'referralDetails.batchYear' => 'nullable|digits:4',
    
            'referraltype' => 'required|string|in:I am a referral,Through family,YouTube,Twitter,Facebook/Instagram Ad',

        ]);
        $applicantData = array_merge($validatedData['personalDetails'], [
            'referraltype' => $validatedData['referraltype'],
            'updated_at' => now(),
        ]);
        $applicant = Applicant::create($applicantData);
    
        $guardianDetails = $validatedData['guardianDetails'];
        $guardianDetails['applicant_id'] = $applicant->id;
        GuardianDetail::create($guardianDetails);
    
        $programDetails = $validatedData['programDetails'];
        $programDetails['applicant_id'] = $applicant->id;
        ProgramDetail::create($programDetails);

        $referralDetails = $validatedData['referralDetails'];
        $isReferralDetailsEmpty = collect($referralDetails)->every(function ($value) {
            return empty($value);
        });
        
        if (!$isReferralDetailsEmpty) {
            $referralDetails = $validatedData['referralDetails'];
            $referralDetails['applicant_id'] = $applicant->id;
            ReferralDetail::create($referralDetails);
        }
        return response()->json([
            'message' => 'Data stored successfully!',
            'applicant_id' => $applicant->id,
        ]);
    }

    public function getapplicants()
    {
        $applicants = Applicant::with(['guardianDetail', 'programDetail', 'referralDetail']) ->orderBy('created_at', 'desc')->get();  
        return response()->json($applicants);
    }
}
