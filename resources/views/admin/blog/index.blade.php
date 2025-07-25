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
                                <h4 class="card-title">Blogs</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
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
                                                                <th>Thumbnail</th>
                                                                <th>Title</th>
                                                                <th>Category</th>
                                                                <th>Status</th>

                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($blogs as $blog)
                                                                <tr>
                                                                    <td><img src="{{ asset($blog->image) }}" width="100" alt=""></td>
                                                                    <td>{{ $blog->title }}</td>
                                                                    <td>{{ $blog->category->name }}</td>
                                                                    <td>
                                                                        @if ($blog->status == 1)
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                                                            class="btn-sm btn-primary">
                                                                            <i class="ti ti-eye"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                                            class="btn-sm btn-primary">
                                                                            <i class="ti ti-edit"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.blogs.destroy', $blog->id) }}" class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Data Found!</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $blogs->links() }}
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
