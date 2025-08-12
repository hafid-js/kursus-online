@props(['src' => null])

@php
    $imageSrc = $src ?: url('/frontend/assets/images/blank.png');
@endphp

<span class="avatar avatar-xl mb-3" style="background-image: url({{ asset($imageSrc) }})"> </span>

{{-- <img
    src="{{ $imageSrc }}"
    {{ $attributes->merge(['class' => 'img-flint mb-3', 'style' => 'width:100px; height:100px; object-fit:cover;']) }}
> --}}
