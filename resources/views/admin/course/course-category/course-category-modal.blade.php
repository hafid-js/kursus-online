<form id="updateCourseCatForm" action="{{ route('admin.course-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <x-image-preview src="{{ url($category->image) }}"/>
            <x-input-file-block name="image" :value="$category->image" />
            <div class="text-danger mt-1" id="error-update-image"></div>
        </div>
        <div class="mb-3">
             <x-image-preview src="{{ url($category->background) }}"/>
            <x-input-file-block name="background" :value="$category->background" />
            <div class="text-danger mt-1" id="error-update-background"></div>
        </div>
        <div class="mb-3">
            <x-input-block name="name" :value="$category->name" placeholder="Enter category name" />
            <div class="text-danger mt-1" id="error-update-name"></div>
        </div>
        <div class="mb-3">
            <x-input-toggle-block name="show_at_trending" :checked="$category->show_at_trending" label="Show at Trending" />
        </div>
        <div class="mb-3">
            <x-input-toggle-block name="status" :checked="$category->status" label="Status" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
