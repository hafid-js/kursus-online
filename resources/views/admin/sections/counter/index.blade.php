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
                                <h4 class="card-title">Create Level</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.counter-section.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.counter-section.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Counter One</label>
                                                <input type="text" class="form-control" name="counter_one" value="{{ $counter?->counter_one }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('counter_one')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title One</label>
                                                <input type="text" class="form-control" name="title_one" value="{{ $counter?->title_one }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Counter Two</label>
                                                <input type="text" class="form-control" name="counter_two" value="{{ $counter?->counter_two }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('counter_two')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title Two</label>
                                                <input type="text" class="form-control" name="title_two" value="{{ $counter?->title_two }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Counter Three</label>
                                                <input type="text" class="form-control" name="counter_three" value="{{ $counter?->counter_three }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('counter_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title Three</label>
                                                <input type="text" class="form-control" name="title_three" value="{{ $counter?->title_three }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Counter Four</label>
                                                <input type="text" class="form-control" name="counter_four" value="{{ $counter?->counter_four }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('counter_four')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title Four</label>
                                                <input type="text" class="form-control" name="title_four" value="{{ $counter?->title_four }}"
                                                    placeholder="">
                                                <x-input-error :messages="$errors->get('title_four')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="ti ti-device-floppy"></i> Create
                                                </button>
                                            </div>
                                        </div>
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
