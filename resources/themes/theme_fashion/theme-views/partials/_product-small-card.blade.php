<div class="similer-product-item">
    <div class="img">
        <a href="{{route('product',$product->slug)}}">
            <img loading="lazy" src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                alt="img/products" onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
        </a>
        <a href="javascript:" class="wish-icon p-2 addWishlist_function_view_page" data-id="{{$product['id']}}">
            @php($wishlist = count($product->wish_list)>0 ? 1 : 0)
            <i class="{{($wishlist == 1?'bi-heart-fill text-danger':'bi-heart')}}  wishlist_{{$product['id']}}"></i>
        </a>
    </div>
    <div class="cont thisIsALinkElement" data-linkpath="{{route('product',$product->slug)}}">
        <h6 class="title">
            <a href="{{route('product',$product->slug)}}" title="{{ $product['name'] }}">{{ Str::limit($product['name'], 18) }}</a>
        </h6>
        <strong class="text-text-2">
            {{\App\CPU\Helpers::currency_converter(
                $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
            )}}
        </strong>
    </div>
</div>
