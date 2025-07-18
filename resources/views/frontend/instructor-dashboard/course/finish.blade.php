@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')

    <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
        tabindex="0">
        <div class="dashboard_add_courses">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-contact2" role="tabpanel"
                    aria-labelledby="pills-contact-tab2" tabindex="0">
                    <div class="dashboard_add_course_finish">
                        <form action="#" class="more_info_form course-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course->id }}">
                            <input type="hidden" name="current_step" value="4">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="add_course_more_info_input">
                                        <label for="#">Message for Reviewer</label>
                                        <textarea rows="7" placeholder="Message for Reviewer" name="message">{!! @$course?->message_for_reviewer !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="add_course_more_info_input mb-0">
                                        <label for="#">Status *</label>
                                        <select class="select_2" name="status" required>
                                            <option value="">Please Select</option>
                                            <option @selected(@$course?->status == 'active') value="active">Active</option>
                                            <option @selected(@$course?->status == 'inactive') value="inactive">InActive</option>
                                            <option @selected(@$course?->status == 'draft') value="draft">Draft</option>
                                        </select>
                                        </select>
                                        <button type="submit" class="common_btn mt_25">Save</button>
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
