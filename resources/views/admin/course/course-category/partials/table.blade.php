@forelse ($categories as $category)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><img src="{{ asset($category->image) }}" alt=""></td>
        <td>{{ $category->name }}</td>
        <td>
            @if ($category->show_at_trending == 1)
                <span class="badge bg-lime text-lime-fg">Yes</span>
            @else
                <span class="badge bg-red text-red-fg">No</span>
            @endif
        </td>
        <td>
            @if ($category->status == 1)
                <span class="badge bg-lime text-lime-fg">Yes</span>
            @else
                <span class="badge bg-red text-red-fg">No</span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.course-sub-categories.index', $category->id) }}" class="btn-sm text-warning">
                <i class="ti ti-list"></i>
            </a>
            <a class="edit edit_course_category" data-category-id="{{ $category->id }}" href="javascript:;"><i
                    class="ti ti-edit" aria-hidden="true"></i></a>
            <a href="{{ route('admin.course-categories.destroy', $category->id) }}" class="text-red delete-item">
                <i class="ti ti-trash"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">No Data Found!
        </td>
    </tr>
@endforelse

