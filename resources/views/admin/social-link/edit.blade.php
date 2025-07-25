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
                                <h4 class="card-title">Update Social Link</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.social-links.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.social-links.update', $socialLink->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                             <x-input-block name="icon" placeholder="Enter icon" value="{{ $socialLink->icon }}" />
                                                 <p>Search Icon : <a href="https://fontawesome.com/icons" target="_blank" class="text-red">FontAwesome.com</a> </p>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-block name="url" placeholder="Enter url" value="{{ $socialLink->url }}" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="status" label="Status" :checked="$socialLink->status == 1" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ti ti-device-floppy"></i> Update
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
