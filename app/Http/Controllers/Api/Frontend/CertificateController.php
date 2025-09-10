<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Models\Course;
use App\Models\WatchHistory;
use App\Traits\ApiResponseTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Download certificate PDF if user completed the course
     *
     * @param  Course  $course
     * @return StreamedResponse|JsonResponse
     */
    public function download(Course $course)
    {
        $user = auth()->user();

        $watchedLessonCount = WatchHistory::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'is_completed' => 1,
        ])->count();

        $lessonCount = $course->lessons()->count();

        if ($watchedLessonCount != $lessonCount) {
            return $this->sendError('You have not completed the course', 403);
        }

        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();

        // Tentukan view certificate berdasarkan role user
        if ($user->role === 'student') {
            $html = view('frontend.student-dashboard.enrolled-course.certificate', compact('certificate', 'certificateItems'))->render();
        } elseif ($user->role === 'instructor') {
            $html = view('frontend.instructor-dashboard.enrolled-course.certificate', compact('certificate', 'certificateItems'))->render();
        } else {
            return $this->sendError('Unauthorized access', 403);
        }

        // Replace placeholders di HTML certificate
        $html = str_replace('[student_name]', $user->name, $html);
        $html = str_replace('[course_name]', $course->title, $html);
        $html = str_replace('[date]', date('d-m-Y'), $html);
        $html = str_replace('[platform_name]', 'Edu Code', $html);
        $html = str_replace('[instructor_name]', $course->instructor->name ?? '', $html);

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        // Stream PDF file sebagai download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'certificate.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="certificate.pdf"',
        ]);
    }
}
