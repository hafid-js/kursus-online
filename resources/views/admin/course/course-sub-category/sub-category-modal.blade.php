<form id="{{ $editMode ? 'updateCourseSubCat' : 'addCourseSubCat' }}"
    action="{{ $editMode
        ? route('admin.course-sub-categories.update', [
            'course_category' => $course_category->id,
            'course_sub_category' => $course_sub_category->id,
        ])
        : route('admin.course-sub-categories.store', $categoryId) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if ($editMode)
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Sub Category' : 'Create Add Category' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            @if ($editMode)
                <x-image-preview src="{{ url($course_sub_category->image ?? '') }}" />
            @endif
            <x-input-file-block name="image" :value="$course_sub_category->image ?? ''" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-image' : 'error-image' }}"></div>
        </div>
        <div class="mb-3">
            <x-input-block name="name" :value="$course_sub_category->name ?? ''" placeholder="Enter sub category name" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-name' : 'error-name' }}"></div>
        </div>
        <div class="mb-3">
            <x-input-toggle-block name="status" label="Status" :checked="$course_sub_category->status ?? false" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
