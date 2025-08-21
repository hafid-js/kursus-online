<div class="row">
@forelse ($users as $user)
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    @if (!empty($user->image))
                        <span class="avatar avatar-xl" style="background-image: url({{ $user->image }})"></span>
                    @else
                        @php $initials = getUserInitials($user->name); @endphp
                        <span class="avatar avatar-xl">{{ $initials }}</span>
                    @endif
                </div>
                <div class="card-title mb-1">{{ $user->name }}</div>
                <div class="text-secondary">{{ $user->headline }}</div>
            </div>
           <a href="{{ $user->role === 'student'
            ? route('admin.students.show', $user->id)
            : route('admin.instructors.show', $user->id) }}"
   class="card-btn">
   View full profile
</a>

        </div>
    </div>
@empty
    <p>No students found.</p>
@endforelse
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $users->links() }}
</div>
