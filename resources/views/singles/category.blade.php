<div class="pentry item-w1 item-h1 cat{{ rand(1,3) }}">
    <a href="#" title="">
        <img src="{{ Asset::get_image_path('category-image','thumb',$item->image) }}" alt="" class="img-responsive">
        <div><span>{{ $item->name }}</span></div>
    </a>
</div>