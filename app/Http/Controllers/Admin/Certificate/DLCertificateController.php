<?php

namespace App\Http\Controllers\Admin\Certificate;

use App\Models\Courses;
use App\Models\MyAward;
use App\Models\Signature;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DLCertificateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu send certificate', ['only' => ['index', 'view', 'sendEmail', 'showCertificate']]);
    }

    public function index()
    {
        $courses = Courses::withCount(['applicants as applicant_count' => function ($query) {
            $query->where('certificate_status', 0)
                ->where('status', 1)
                ->where('award_applied', 2)
                ->where('school_year', getAcademicYear());
        }])
            ->get();
        return view('admin.send-awardees-certificates.deans-list-award.index', compact('courses'));
    }

    public function view($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        //count
        $count = StudentApplicant::where('certificate_status', '1')->where('status', '1')->where('award_applied', '2')->where('course_id', $courses->id)->where('school_year', getAcademicYear())->count();
        $total = StudentApplicant::where('status', '1')->where('award_applied', '2')->where('course_id', $courses->id)->where('school_year', getAcademicYear())->count();

        $awardees = StudentApplicant::where('award_applied', '2')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->where('school_year', getAcademicYear())
            ->orderBy('gwa', 'asc')
            ->get();
        return view('admin.send-awardees-certificates.deans-list-award.view', compact('courses', 'awardees', 'count', 'total'));
    }

    public function sendEmail(Request $request)
    {
        $name1 = Signature::where('certificate', '1')->first();
        $name2 = Signature::where('certificate', '1')->skip(1)->take(1)->first();
        $name3 = Signature::where('certificate', '1')->skip(2)->take(1)->first();
        $name4 = Signature::where('certificate', '1')->skip(3)->take(1)->first();

        $users = StudentApplicant::whereIn("id", $request->ids)->get();
        foreach ($users as $user) {
            $data = [
                'app_id' => shortUrl() . '/verify-award/' . $user->stud_app_id,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'gwa'  => $user->gwa,
                'award'  => $user->award->acad_code,
                'award_name'  => $user->award->name,
                'summer' => '',
                'fifth_1' => '',
                'fifth_2' => '',
                'sy'  => $user->school_year,
                'name1' => $name1->rep_name,
                'position1' => $name1->position,
                'signature1' => $name1->signature,

                'name2' => $name2->rep_name,
                'position2' => $name2->position,
                'signature2' => $name2->signature,

                'name3' => $name3->rep_name,
                'position3' => $name3->position,
                'signature3' => $name3->signature,

                'name4' => $name4->rep_name,
                'position4' => $name4->position,
                'signature4' => $name4->signature
            ];
            $details = ['email' => $user->users->email];
            SendEmailJob::dispatch($details, $data, $data['app_id']);

            MyAward::updateOrCreate(
                ['application_id' => $user->stud_app_id],
                [
                    'user_id' => $user->users->id,
                    'award_acronym' => $user->award->acad_code,
                    'award_name' => $user->award->name,
                    'school_year' => $user->school_year
                ]
            );
        }
        StudentApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully']);
    }

    public function showCertificate($course_code, $id)
    {
        $sig = Signature::where('certificate', '1')->orderBy('id', 'asc')->get();
        $stud = StudentApplicant::with('users')->find($id);
        $data = [
            'fname' => $stud->users->first_name,
            'mname' => $stud->users->middle_name,
            'lname' => $stud->users->last_name,
            'gwa'  => $stud->gwa,
            'award'  => $stud->award_applied,
            'sy'  => $stud->school_year
        ];

        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate(shortUrl() . '/verify-award/' . $stud->stud_app_id));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.deans-list-award.show', $data, compact('qrcode', 'sig'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }
}
