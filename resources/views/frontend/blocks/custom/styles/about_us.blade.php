@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image = $block->image != '' ? $block->image : '';
    $image_background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
    
    // Filter all blocks by parent_id
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
    $items = [];
    $i = 0;
    foreach ($block_childs as $item) {
        $items[$i] = $item;
        $i++;
    }
  @endphp

  <div id="introduce" class="section bg-white m-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="fancy-title title-bottom-border center">
            <h3 class="text-uppercase">{{ $title }}</h3>
          </div>
          <p>
            {!! $brief !!}
          </p>
        </div>
        <div class="col-lg-6 col-sm-12 d-flex justify-content-center"
          style="
              background-image: url('{{ $image }}');
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
            ">
        </div>
        <div class="col-lg-6 col-sm-12 p-5">
          @if ($block_childs)
            @foreach ($block_childs as $item)
              @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                $content = $item->json_params->content->{$locale} ?? $item->content;
                $image = $item->image != '' ? $item->image : null;
                $image_background = $item->image_background != '' ? $item->image_background : null;
                $video = $item->json_params->video ?? null;
                $video_background = $item->json_params->video_background ?? null;
                $url_link = $item->url_link != '' ? $item->url_link : '';
                $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                $icon = $item->icon != '' ? $item->icon : '';
                $style = isset($item->json_params->style) && $item->json_params->style == 'slider-caption-right' ? 'd-none' : '';
                
                $image_for_screen = null;
                if ($agent->isDesktop() && $image_background != null) {
                    $image_for_screen = $image_background;
                } else {
                    $image_for_screen = $image;
                }
                
              @endphp
              <div class="">
                <h4 class="mb-3 text-uppercase">
                  {!! $title !!}
                </h4>
                <p>
                  {!! $brief !!}
                </p>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>

@endif
