@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image_background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
    // Filter all blocks by parent_id
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  @endphp
  <style>
    .clients .main-marq .box .item .img {
      width: 210px;
    }

    .clients .main-marq .box .item {
      padding: 15px;
    }

    body.light .clients .main-marq .box .item .img img {
      -webkit-filter: invert(0);
      filter: invert(0);
    }
  </style>

  <div class="clients section-padding bord-thin-top bord-thin-bottom">
    <div class="container-xxl o-hidden">
      <div class="row wow fadeInUp">
        <div class="col-lg-12 text-center">
          <div class="sec-head mb-80">
            <h2 class="fw-800">
              {!! $brief !!}
            </h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="main-marq">
            <div class="slide-har st1">

              <div class="box">
                @if ($block_childs)
                  @foreach ($block_childs as $item)
                    @php
                      $title = $item->json_params->title->{$locale} ?? $item->title;
                      $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                      $image = $item->image != '' ? $item->image : null;
                      $url_link = $item->url_link != '' ? $item->url_link : '';
                      $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                      $icon = $item->icon != '' ? $item->icon : '';
                      $style = $item->json_params->style ?? '';
                    @endphp
                    <div class="item">
                      <div class="img">
                        <img src="{{ $image }}" alt="">
                      </div>
                      <a href="{{ $url_link }}" class="link" data-splitting>{{ $url_link_title }}</a>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="box">
                @if ($block_childs)
                  @foreach ($block_childs as $item)
                    @php
                      $title = $item->json_params->title->{$locale} ?? $item->title;
                      $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                      $image = $item->image != '' ? $item->image : null;
                      $url_link = $item->url_link != '' ? $item->url_link : '';
                      $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                      $icon = $item->icon != '' ? $item->icon : '';
                      $style = $item->json_params->style ?? '';
                    @endphp
                    <div class="item">
                      <div class="img">
                        <img src="{{ $image }}" alt="">
                      </div>
                      <a href="{{ $url_link }}" class="link" data-splitting>{{ $url_link_title }}</a>
                    </div>
                  @endforeach
                @endif
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endif
