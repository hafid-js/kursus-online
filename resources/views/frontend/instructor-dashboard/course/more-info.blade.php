@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')

    <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
        tabindex="0">
        <div class="add_course_basic_info">
            <form action="" class="more_info_form course-form">
                @csrf
                <input type="hidden" name="id" value="{{ request()?->id }}">
                <input type="hidden" name="current_step" value="2">
            <input type="hidden" name="next_step" value="3">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Capacity</label>
                            <input type="text" placeholder="Capacity" class="only-number" name="capacity" value="{{ $course?->capacity }}">
                            <p>leave blank for unlimited</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Course Duration (Minutes)*</label>
                            <input type="text" placeholder="300" name="duration" class="only-number" value="{{ $course->duration }}">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="qna" @checked($course?->qna === 1) value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Q&amp;A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="cartificate" @checked($course?->certificate === 1) value="1" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Category *</label>
                            <select class="select_2 select2-hidden-accessible" name="category" data-select2-id="select2-data-1-ygmp"
                                tabindex="-1" aria-hidden="true">
                                <option value=""> Please Select </option>
                                @foreach ($categories as $category)
                                    @if ($category->subCategories->isNotEmpty())
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->subCategories as $subCategory)
                                                <option @selected($course?->category_id == $subCategory->id) value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Level</h3>
                            @foreach ($levels as $level)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="level" @checked($level->id == $course->course_level_id) value="{{ $level->id }}" id="id-{{ $level->id }}"
                                    >
                                <label class="form-check-label" for="id-{{ $level->id }}">
                                    {{ $level->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Language</h3>
                            @foreach ($languages as $language)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="language" @checked($language->id == $course->course_language_id) value="{{ $language->id }}" id="id-{{ $language->id }}"
                                    >
                                <label class="form-check-label" for="id-{{ $language->id }}">
                                    {{ $language->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
