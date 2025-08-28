<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function download(Course $course)
    {
        $user = user();

        $watchedLessonCount = \App\Models\WatchHistory::where([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'is_completed' => 1,
        ])->count();

        $lessonCount = $course->lessons()->count();

        if ($watchedLessonCount != $lessonCount) {
            return abort(404);
        }

        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();

        if ('student' === $user->role) {
            $html = view('frontend.student-dashboard.enrolled-course.certificate', compact('certificate', 'certificateItems'))->render();
        } elseif ('instructor' === $user->role) {
            $html = view('frontend.instructor-dashboard.enrolled-course.certificate', compact('certificate', 'certificateItems'))->render();
        } else {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $html = str_replace('[student_name]', $user->name, $html);
        $html = str_replace('[course_name]', $course->title, $html);
        $html = str_replace('[date]', date('d-m-Y'), $html);
        $html = str_replace('[platform_name]', 'Edu Code', $html);
        $html = str_replace('[instructor_name]', $course->instructor->name ?? '', $html);

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        return $pdf->download('certificate.pdf');
    }
}
