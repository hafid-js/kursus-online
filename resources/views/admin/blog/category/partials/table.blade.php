 @forelse ($categories as $category)
     <tr>
         <td>{{ $loop->iteration }}</td>
         <td>{{ $category->name }}</td>
         <td>{{ $category->slug }}</td>
         <td>
             @if ($category->status == 1)
                 <span class="badge bg-lime text-lime-fg">Active</span>
             @else
                 <span class="badge bg-red text-red-fg">Inactive</span>
             @endif
         </td>
         <td>
             <a class="edit edit_blog_category" data-category-id="{{ $category->id }}" href="javascript:;"><i
                     class="ti ti-edit" aria-hidden="true"></i></a>
             <a href="{{ route('admin.blog-categories.destroy', $category->id) }}" class="text-red delete-item">
                 <i class="ti ti-trash"></i>
             </a>
         </td>
     </tr>
 @empty
     <tr>
         <td colspan="4" class="text-center">No Data Found!</td>
     </tr>
 @endforelse
