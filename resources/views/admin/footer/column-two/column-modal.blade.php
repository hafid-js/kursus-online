<form id="{{ $editMode ? 'updateColumn' : 'addColumn' }}"
    action="{{ $editMode ? route('admin.footer-column-two.update', $column->id) : route('admin.footer-column-two.store') }}"
    method="POST">

    @csrf
    @if ($editMode)
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Footer Column' : 'Add Footer Column' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <x-input-block name="title" value="{{ $column->title ?? '' }}" placeholder="Enter Title" />
                      <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-title' : 'error-title' }}"></div>
            </div>
            <div class="col-md-6 mb-3">
                <x-input-block name="url" value="{{ $column->url ?? '' }}" placeholder="Enter Url" />
                      <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-url' : 'error-url' }}"></div>
            </div>
            <div class="col-md-12 mb-3">
                <x-input-toggle-block name="status" label="Status" :checked="($column->status ?? 0) == 1" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
