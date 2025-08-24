<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
use App\DataTables\StudentCourseEnrolledDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'instructor')
            ->where('approve_status', 'approved')
            ->where('document_status', 'approved');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(8);

        if ($request->ajax()) {
            return view('admin.user.partials.user-list', compact('users'))->render();
        }

        return view('admin.user.instructor.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(
        CourseDataTable $courseDataTable,
        StudentCourseEnrolledDataTable $studentCourseEnrolledDataTable,
        string $id
    ) {
        $studentCourseEnrolledDataTable->setStudentId(null);
        $courseDataTable->setInstructorId($id);
        $studentCourseEnrolledDataTable->setInstructorId($id);

        $instructor = User::findOrFail($id);

        if ($instructor->role !== 'instructor') {
            abort(404);
        }


        return view('admin.user.instructor.detail', [
            'courseDataTable' => $courseDataTable->html(),
            'studentCourseEnrolledDataTable' => $studentCourseEnrolledDataTable->html(),
            'instructor' => $instructor
        ]);
    }

    public function getAllCourse(CourseDataTable $courseDataTable, string $id)
    {
        $courseDataTable->setInstructorId($id);

        return $courseDataTable->render('admin.user.instructor.course_table');
    }

    public function getAllStudentEnrolled(StudentCourseEnrolledDataTable $studentCourseEnrolledDataTable, string $id)
    {
        $studentCourseEnrolledDataTable->setStudentId(null);
        $studentCourseEnrolledDataTable->setInstructorId($id);

        return $studentCourseEnrolledDataTable->render('admin.user.instructor.student_enrolled_table');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
