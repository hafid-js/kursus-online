<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
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
            ->where('approve_status', 'approved');

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

    public function show(CourseDataTable $dataTable, string $id)
    {
        $orderItems = OrderItem::with([
            'course.instructor',
            'order.customer'
        ])
            ->whereHas('course', function ($query) use ($id) {
                $query->where('instructor_id', $id);
            })
            ->get();

        $dataTable->setInstructorId($id);
        return $dataTable->render('admin.user.instructor.detail', compact('orderItems'));
    }



    //         $dataTable->setInstructorId($id); // Filter berdasarkan instructor_id
    //      $courses = Course::with('instructor')->where('instructor_id', $id)->get();
    //  // Buat tampilin info di view

    //  return $dataTable->render('admin.user.instructor.detail', compact( 'courses'));

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
