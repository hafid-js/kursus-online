<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Lesson</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form
            action="{{ $editMode == true
                ? route('instructor.course-content.update-lesson', $lesson->id)
                : route('instructor.course-content.store-lesson') }}"
            method="POST">
            @csrf
            <input type="hidden" name="course_id" id="" value="{{ $courseId }}">
            <input type="hidden" name="chapter_id" id="" value="{{ $chapterId }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-3 add_course_basic_info_imput">
                        <label for="">Title</label>
                        <input type="text" class="add_course_basic_info_imput" name="title"
                            value="{{ @$lesson?->title }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="">Source</label>
                        <select name="source" class="nice-select add_course_basic_info_imput storage" required>
                            <option value="">Select</option>
                            @foreach (config('course.video_sources') as $source => $name)
                                <option @selected(@$lesson?->storage == $source) value="{{ $source }}">{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div
                        class="add_course_basic_info_imput upload_source {{ @$lesson->storage == 'upload' ? '' : 'd-none' }}">
                        <label for="#">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control source_input" type="text" name="file"
                                value="{{ @$lesson->storage == 'upload' ? @$lesson->file_path : '' }}"
                                {{ @$lesson->storage != 'upload' ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div
                        class="add_course_basic_info_imput external_source {{ @$lesson->storage != 'upload' ? '' : 'd-none' }}">
                        <label for="#">Path</label>
                        <input type="text" name="url" class="source_input"
                            value="{{ @$lesson->storage != 'upload' ? @$lesson->file_path : '' }}"
                            {{ @$lesson->storage == 'upload' ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="">File Type</label>
                        <select name="file_type" id="" class="add_course_basic_info_imput">
                            <option value="">Select</option>
                            @foreach (config('course.file_type') as $source => $name)
                                <option @selected(@$lesson?->file_type == $source) value="{{ $source }}">{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3 add_course_basic_info_imput">
                        <label for="">Duration</label>
                        <input type="text" class="" name="duration" value="{{ @$lesson?->duration }}"
                            required>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="add_course_more_info_checkbox">
                        <div class="form-check" style="width: 40%;">
                            <input @checked(@$lesson?->is_preview === 1) class="form-check-input" type="checkbox"
                                name="is_preview" value="1" id="preview">
                            <label class="form-check-label" for="preview">Is Preview</label>
                        </div>
                        <div class="form-check" style="width: 40%;">
                            <input @checked(@$lesson?->downloadable === 1) class="form-check-input" type="checkbox"
                                name="downloadable" value="1" id="downloable">
                            <label class="form-check-label" for="downloable">Downloable</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="add_course_basic_info_imput" cols="30" rows="10" required>{!! @$lesson?->description !!}</textarea>
                    </div>
                </div>
                <div class="form-group text-end">
                    <button type="submit"
                        class="btn btn-primary">{{ @$editMode == true ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#lfm').filemanager('file');
</script>
