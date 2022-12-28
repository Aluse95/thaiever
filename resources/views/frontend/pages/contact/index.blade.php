@extends('frontend.layouts.default')

@php
  $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
@endphp
@push('style')
  <style>
    .fluid-width-video-wrapper {
      height: 100%;
    }
  </style>
@endpush
@section('content')
  {{-- Print all content by [module - route - page] without blocks content at here --}}
  <section id="page-title" class="page-title-parallax page-title-center page-title d-none"
    style="background-image: url('{{ $image_background }}'); background-size: cover; padding: 120px 0;"
    data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
    <div id="particles-line"></div>

    <div class="container clearfix mt-4">
      <h1>{{ $page_title }}</h1>
    </div>
  </section>

  {{-- @isset($web_information->source_code->map)
    <section class="vh-60">
      {!! $web_information->source_code->map !!}
    </section>
  @endisset --}}

  <section id="content">
    <div class="content-wrap">
      <div class="container">

        <div class="row gutter-40 col-mb-80">
          <div class="postcontent col-lg-9">

            <h3>LIÊN HỆ TRỰC TUYẾN</h3>

            <div class="">

              <div class="form-result"></div>

              <form class="mb-0 form_ajax" method="post" action="{{ route('frontend.contact.store') }}">
                @csrf
                <div class="form-process">
                  <div class="css3-spinner">
                    <div class="css3-spinner-scaler"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="name">@lang('Fullname') <small class="text-danger">*</small></label>
                    <input type="text" id="name" name="name" value="" class="sm-form-control required"
                      required />
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="email">Email <small class="text-danger">*</small></label>
                    <input type="email" id="email" name="email" value=""
                      class="required email sm-form-control" required />
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="phone">@lang('phone') <small class="text-danger">*</small></label>
                    <input type="text" id="phone" name="phone" value="" class="sm-form-control" required />
                  </div>

                  <div class="w-100"></div>

                  <div class="col-12 form-group">
                    <label for="content">@lang('Content') <small class="text-danger">*</small></label>
                    <textarea class="required sm-form-control" id="content" name="content" rows="6" cols="30" required></textarea>
                  </div>


                  <div class="col-12 form-group">
                    <button class="button button-border button-rounded button-fill button-green m-0 ls0 text-uppercase"
                      type="submit" name="submit" value="submit">
                      <span>Gửi liên hệ</span>
                    </button>
                  </div>
                </div>

                <input type="hidden" name="is_type" value="contact">

              </form>
            </div>

          </div><!-- .postcontent end -->

          <div class="sidebar col-lg-3">
            <address>
              <strong>@lang('address'):</strong><br>
              {!! $web_information->information->address ?? '' !!}
            </address>
            <abbr title="Phone Number">
              <strong>@lang('phone'):</strong>
            </abbr>
            {!! $web_information->information->phone ?? '' !!}<br>
            <abbr title="Email Address"><strong>Email:</strong></abbr>
            {!! $web_information->information->email ?? '' !!}

          </div><!-- .sidebar end -->
        </div>

      </div>
    </div>
  </section>

  {{-- End content --}}
@endsection
