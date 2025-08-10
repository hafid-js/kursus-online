<form id="updateCategoryForm" action="{{ route('admin.blog-categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <x-input-block name="name" placeholder="Enter name" :value="$category->name" />
            <div class="text-danger mt-1" id="error-update-name"></div>
        </div>
        <div class="mb-3">
            <x-input-toggle-block name="status" label="Status" :checked="$category->status == 1" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary ms-auto">Update</button>
    </div>
</form>
