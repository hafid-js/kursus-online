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
                                <h4 class="card-title">Latest Course Categories</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.latest-courses-section.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Category One</label>
                                                <select class="select2" name="category_one"
                                                    data-select2-id="select2-data-1-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value=""> Please Select </option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->subCategories->isNotEmpty())
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->subCategories as $subCategory)
                                                                    <option @selected($latestCourseSection?->category_one == $subCategory->id)
                                                                        value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category_one')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Category Two</label>
                                                <select class="select2" name="category_two"
                                                    data-select2-id="select2-data-2-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value=""> Please Select </option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->subCategories->isNotEmpty())
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->subCategories as $subCategory)
                                                                    <option @selected($latestCourseSection?->category_two == $subCategory->id)
                                                                        value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category_two')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Category Three</label>
                                                <select class="select2" name="category_three"
                                                    data-select2-id="select2-data-3-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value=""> Please Select </option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->subCategories->isNotEmpty())
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->subCategories as $subCategory)
                                                                    <option @selected($latestCourseSection?->category_three == $subCategory->id)
                                                                        value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Category Four</label>
                                                <select class="select2" name="category_four"
                                                    data-select2-id="select2-data-4-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value=""> Please Select </option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->subCategories->isNotEmpty())
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->subCategories as $subCategory)
                                                                    <option @selected($latestCourseSection?->category_four == $subCategory->id)
                                                                        value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category_four')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Category Five</label>
                                                <select class="select2" name="category_five"
                                                    data-select2-id="select2-data-5-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value=""> Please Select </option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->subCategories->isNotEmpty())
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->subCategories as $subCategory)
                                                                    <option  @selected($latestCourseSection?->category_five == $subCategory->id)
                                                                        value="{{ $subCategory->id }}">
                                                                        {{ $subCategory->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category_five')" class="mt-2" />
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
                                    </svg> Create
                                            </button>
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
