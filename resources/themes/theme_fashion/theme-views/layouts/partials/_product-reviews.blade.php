@foreach ($productReviews as $item)
<li>
    <div class="author-area">
        <img loading="lazy" src="{{asset("storage/app/public/profile")}}/{{(isset($item->user)?$item->user->image:'')}}" alt="img"
        onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'" class="mx-1">
        <div class="cont">
            <h6>
                @if($item->user)
                    <div href="javascript:" class="text-capitalize">{{$item->user->f_name}} {{$item->user->l_name}}</div>
                @else
                    <a href="javascript:" class="text-capitalize">{{translate('user_not_exist')}}</a>
                @endif
            </h6>
            <span>
                <i class="bi bi-star-fill text-star"></i>
                {{$item->rating}}/5</span>
        </div>
    </div>
    <div class="content-area">
        <p class="mb-3 mx-3">
            {!! $item->comment !!}
        </p>
        <div class="products-comments-img d-flex flex-wrap gap-2">
            @foreach (json_decode($item->attachment) as $img)
                @if(file_exists(base_path("storage/app/public/review/".$img)))
                    <a href="{{asset("storage/app/public/review")}}/{{$img}}" class="lightbox_custom mx-3">
                        <img loading="lazy" src="{{asset("storage/app/public/review")}}/{{$img}}" alt="{{$item->name}}"
                        onerror="this.src='{{theme_asset('assets/img/image-place-holder.png')}}'">
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</li>
@endforeach
