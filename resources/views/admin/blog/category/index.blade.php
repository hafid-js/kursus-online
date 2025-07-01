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
                                <h4 class="card-title">Blog Categories</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
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
                                                                <th>Name</th>
                                                                <th>Slug</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($categories as $category)
                                                                <tr>

                                                                    <td>{{ $category->name }}</td>
                                                                    <td>{{ $category->slug }}</td>
                                                                    <td>
                                                                        @if ($category->status == 1)
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.blog-categories.edit', $category->id) }}"
                                                                            class="btn-sm btn-primary">
                                                                            <i class="ti ti-edit"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.blog-categories.destroy', $category->id) }}" class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3" class="text-center">No Data Found!</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $categories->links() }}
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
