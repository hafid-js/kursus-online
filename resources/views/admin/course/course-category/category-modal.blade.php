<form id="{{ $editMode ? 'updateCourseCatForm' : 'courseCategoryForm' }}"
      action="{{ $editMode ? route('admin.course-categories.update', $category->id) : route('admin.course-categories.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @if($editMode)
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Category' : 'Add Category' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <div class="mb-3">
            @if($editMode)
                <x-image-preview src="{{ url($category->image) }}"/>
            @endif
            <x-input-file-block name="image" :value="$category->image ?? ''" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-image' : 'error-image' }}"></div>
        </div>

        <div class="mb-3">
            @if($editMode)
                <x-image-preview src="{{ url($category->background) }}"/>
            @endif
            <x-input-file-block name="background" :value="$category->background ?? ''" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-background' : 'error-background' }}"></div>
        </div>

        <div class="mb-3">
            <x-input-block name="name" :value="$category->name ?? ''" placeholder="Enter category name" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-name' : 'error-name' }}"></div>
        </div>

        <div class="mb-3">
            <x-input-toggle-block name="show_at_trending" label="Show at Trending" :checked="$category->show_at_trending ?? false" />
        </div>

        <div class="mb-3">
            <x-input-toggle-block name="status" label="Status" :checked="$category->status ?? false" />
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
