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
                                <h4 class="card-title">Update Custom Page</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.custom-page.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.custom-page.update', $page->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                         <div class="col-md-12">
                                            <x-input-block name="title" placeholder="Enter Title" :value="$page->title" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Description</label>
                                            <textarea name="description" id="" class="editor" cols="30" rows="10">{!! $page->description !!}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <x-input-block name="seo_title" placeholder="Enter SEO Title" :value="$page->seo_title" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="" class="mb-2">Seo Description</label>
                                                <textarea name="seo_description" class="form-control" id="">{!! $page->seo_description !!}</textarea>
                                                <x-input-error :messages="$errors->get('seo_description')" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="show_at_nav" label="Show at Navigation" :checked="$page->show_at_nav == 1" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="status" label="Status" :checked="$page->status == 1" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg> Update
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
