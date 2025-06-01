@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Certificate Builder</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.certificate-builder.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <label for="" class="form-label">Certificate Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Cerfiticate Title">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="form-label">Certificate Subtitle</label>
                                        <input type="text" class="form-control" name="subtitle" placeholder="Enter Cerfiticate Subtitle">
                                        <x-input-error :messages="$errors->get('subtitle')" class="mt-2"/>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="form-label">Certificate Description</label>
                                        <input type="text" class="form-control" name="description" placeholder="Enter Cerfiticate Description">
                                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="form-label">Certificate Background</label>
                                        <input type="file" class="form-control" name="background">
                                        <x-input-error :messages="$errors->get('background')" class="mt-2"/>
                                    </div>
                                     <div class="form-group mt-3">
                                        <label for="" class="form-label">Certificate Signature</label>
                                        <input type="file" class="form-control" name="signature">
                                        <x-input-error :messages="$errors->get('signature')" class="mt-2"/>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Certificate Builder</h3>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
