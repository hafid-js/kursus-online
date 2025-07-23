@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-8">
                <div class="card card-lg">
                  <div class="card-body">
                  <div class="d-block">
                     <img src="{{ asset($blog->image) }}" class="card-img-top">
                  </div>
                  </div>
                </div>
              </div>
                </div>
            </div>
        </div>
    </div>

@endsection
