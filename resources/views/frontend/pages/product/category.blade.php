@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
  
  $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
  $image = $taxonomy->json_params->image ?? null;
  $seo_title = $taxonomy->json_params->seo_title ?? $title;
  $seo_keyword = $taxonomy->json_params->seo_keyword ?? null;
  $seo_description = $taxonomy->json_params->seo_description ?? null;
  $seo_image = $image ?? null;
@endphp
@push('style')
  <style>
    .product .entry-image {
      position: relative !important;
    }

    .product .entry-title {
      position: absolute;
      bottom: 0;
      background-color: #FFF;
      opacity: 0.75;
      left: 50%;
      width: 100%;
      transform: translateX(-50%);
      padding: 10px 0px;
    }

    .entry-image a.img-link {
      height: 400px;
      overflow: hidden;
    }

    .link-hover:hover {
      background-color: green !important;
    }

    .entry-image img {
      height: 100%;
    }
  </style>
@endpush
@section('content')
  {{-- Print all content by [module - route - page] without blocks content at here --}}
  <section id="page-title" class="page-title-parallax page-title-center page-title"
    style="background-image: url('{{ $image_background }}'); background-size: cover;"
    data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
    <div id="particles-line"></div>

    <div class="container clearfix mt-4">
      {{-- <div class="badge rounded-pill border border-light text-light">{{ $page_title }}</div> --}}
      <ol class="breadcrumb d-none">
        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">@lang('Home')</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $page->name ?? '' }}</li>
      </ol>
      <h1 class="">{{ $page_title }}</h1>
    </div>
  </section>

  <section id="content">

    <div class="content-wrap">
      <div class="container mb-3">

        <div class="row mb-5 clearfix">
          <div class="postcontent col-lg-12">
            <div class="row">
              @foreach ($posts as $item)
                @php
                  $title = $item->json_params->title->{$locale} ?? $item->title;
                  $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                  $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                  // $date = date('H:i d/m/Y', strtotime($item->created_at));
                  $date = date('d', strtotime($item->created_at));
                  $month = date('M', strtotime($item->created_at));
                  $year = date('Y', strtotime($item->created_at));
                  // Viet ham xu ly lay slug
                  $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                  $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                @endphp
                <div class="col-md-6 col-lg-4 product">
                  <article class="entry">
                    <div class="entry-image mb-3">
                      <a href="{{ $alias }}" class="img-link"><img src="{{ $image }}"
                          alt="{{ $title }}"></a>

                      <div class="bg-overlay">
                        <div class="bg-overlay-content dark flex-column" data-hover-animate="fadeIn">
                          <div class="d-flex mb-3" style="width:75%">
                            <a href="{{ $alias }}" data-hover-animate="fadeInDownSmall"
                              data-hover-animate-out="fadeOutDownSmall" data-hover-speed="1000"
                              style="border: 1px solid #FFFFFF;width:100%; text-align:center;"
                              class="bg-transparent text-light animated py-2 px-5 fadeOutDownSmall link-hover">
                              XEM CHI TIẾT
                              <i class="icon-line-arrow-right"></i>
                            </a>
                          </div>
                          @isset($item->json_params->shop_online)
                            <div class="d-flex" style="width:75%">
                              <a href="{{ $item->json_params->shop_online ?? '' }}" data-hover-animate="fadeInUpSmall"
                                data-hover-animate-out="fadeOutDownSmall" data-hover-speed="1000"
                                style="border: 1px solid #FFFFFF; width:100%; text-align:center;"
                                class="bg-transparent text-light animated py-2 px-5 fadeOutDownSmall link-hover">
                                SHOP ONLINE
                                <i class="icon-line-shopping-cart"></i>
                              </a>
                            </div>
                          @endisset

                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                      </div>
                    </div>
                    <div class="entry-title text-center">
                      <h3><a href="{{ $alias }}">{{ $title }}</a></h3>
                    </div>
                  </article>
                </div>
              @endforeach
              {{ $posts->withQueryString()->links('frontend.pagination.default') }}
            </div>
          </div>

          {{-- @include('frontend.components.sidebar.product') --}}

        </div>
      </div>
    </div>
  </section>
  {{-- End content --}}
@endsection
