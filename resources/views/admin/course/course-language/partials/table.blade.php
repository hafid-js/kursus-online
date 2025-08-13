  @forelse ($languages as $language)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $language->name }}</td>
          <td>{{ $language->slug }}</td>
          <td>
              <a class="edit edit_course_language" data-language-id="{{ $language->id }}" href="javascript:;"><i
                      class="ti ti-edit" aria-hidden="true"></i></a>
              <a href="{{ route('admin.course-languages.destroy', $language->id) }}" class="text-red delete-item">
                  <i class="ti ti-trash"></i>
              </a>
          </td>
      </tr>
  @empty
      <tr>
          <td colspan="3" class="text-center">No Data Found!
          </td>
      </tr>
  @endforelse
