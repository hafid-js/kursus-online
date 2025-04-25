@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Course Sub Categories of: ({{ $course_category->name }})</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.course-categories.index',$course_category->id) }}" class="btn btn-dark">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                    <a href="{{ route('admin.course-sub-categories.create', $course_category->id) }}" class="btn btn-primary">
                                        <i class="ti ti-plus"></i>
                                        Add new
                                    </a>
                                </div>
                            </div>
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-cards">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter card-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Icon</th>
                                                                <th>Name</th>
                                                                <th>Trending</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($subCategories as $category)
                                                                <tr>
                                                                    <td><i class="{{ $category->icon }}"></i></td>
                                                                    <td>{{ $category->name }}</td>
                                                                    <td>
                                                                        @if ($category->show_at_trending == 1)
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($category->status == 1)
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.course-sub-categories.edit', [
                                                                        'course_category' => $course_category->id,
                                                                        'course_sub_category' => $category->id
                                                                        ])}}"
                                                                            class="btn-sm btn-primary">
                                                                            <i class="ti ti-edit"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.course-sub-categories.destroy', [
                                                                        'course_category' => $course_category->id,
                                                                        'course_sub_category' => $category->id
                                                                        ])}}" class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No Data Found!</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- {{ $categories->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
