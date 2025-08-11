<form id="{{ $editMode ? 'updateCourseLevel' : 'addCourseLevel' }}"
      action="{{ $editMode ? route('admin.course-levels.update', $course_level->id) : route('admin.course-levels.store') }}"
      method="POST">

    @csrf
    @if($editMode)
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Level' : 'Add Level' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <x-input-block name="name" :value="$course_level->name ?? ''" placeholder="Enter level name" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-name' : 'error-name' }}"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
