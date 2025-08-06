@extends('frontend.layouts.layout')
@section('content')
<section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Categories</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Categories</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="wsus__category_page mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
             @foreach ($featureCategories as $category )
                <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__category_item_2">
                        <a href="{{ route('courses.index', ['main_category' => $category->slug]) }}" class="wsus__category_item_2_img">
                            <img src="{{ asset($category->background) }}" alt="Category" class="img-fluid w-100">
                        </a>
                        <div class="wsus__category_item_2_text">
                            <span>
                                <img src="{{ asset($category->image) }}" alt="Category" class="img-fluid w-100">
                            </span>
                            <a href="{{ route('courses.index', ['main_category' => $category->slug]) }}" class="title">{{ $category->name }}</a>
                            <p>{{ $category?->active_course_count }} Course <i class="far fa-arrow-right" aria-hidden="true"></i></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
    {{-- Tombol Previous --}}
    @if ($featureCategories->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link" aria-label="Previous"><i class="far fa-arrow-left"></i></span>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $featureCategories->previousPageUrl() }}" aria-label="Previous">
                <i class="far fa-arrow-left"></i>
            </a>
        </li>
    @endif

    {{-- Nomor Halaman --}}
    @for ($i = 1; $i <= $featureCategories->lastPage(); $i++)
        <li class="page-item {{ $i == $featureCategories->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ $featureCategories->url($i) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</a>
        </li>
    @endfor

    {{-- Tombol Next --}}
    @if ($featureCategories->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $featureCategories->nextPageUrl() }}" aria-label="Next">
                <i class="far fa-arrow-right"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <span class="page-link" aria-label="Next"><i class="far fa-arrow-right"></i></span>
        </li>
    @endif
</ul>

                </nav>
            </div>
        </div>
    </section>
@endsection

