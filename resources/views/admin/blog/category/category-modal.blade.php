<form id="{{ $editMode ? 'editCategoryForm' : 'addCategoryForm' }}"
      action="{{ $editMode ? route('admin.blog-categories.update', $category->id) : route('admin.blog-categories.store') }}"
      method="POST">

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
            <x-input-block name="name" placeholder="Enter name" :value="$category->name ?? '' " />
                     <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-name' : 'error-name' }}"></div>
        </div>
        <div class="mb-3">
           <x-input-toggle-block name="status" label="Status" :checked="($category->status ?? 0) == 1" />

    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
