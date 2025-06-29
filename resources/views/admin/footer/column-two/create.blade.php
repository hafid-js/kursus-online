@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create Footer Link</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.footer-column-two.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.footer-column-two.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                         <div class="col-md-6">
                                            <x-input-block name="title" placeholder="Enter Title" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-block name="url" placeholder="Enter Url" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="status" label="Status" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ti ti-device-floppy"></i> Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
