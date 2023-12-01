@extends('theme-views.layouts.app')

@section('title', translate('my_compare_list').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@section('content')
    <section class="user-profile-section section-gap pt-0 mb-5">
        <div class="container">
            @include('theme-views.partials._profile-aside')
            <div class="tab-pane text-capitalize" >
                <div class="table-responsive">
                    @if($compare_lists->count()>0)
                        <h4 class="mx-4 mb-4 text-center d-md-none">{{ translate('product_comparison') }}</h4>
                    @endif
                    <div class="compare-wrapper">
                        <div class="compare-item">
                            <div class="compare-thumb overflow-hidden">
                                <div class="mt-5 pt-lg-4 d-none d-lg-block">
                                    <h2 class="mb-2">{{ translate('product_comparison') }}</h2>
                                    <div>
                                        {{ translate('find_and_select_products_to_see_the_differences_and_similarities_between_them') }}
                                    </div>
                                </div>
                            </div>
                            <ul class="compare-info">
                                @if ($web_config['brand_setting'])
                                    <li>{{ translate('brand') }}</li>
                                @endif

                                <li>{{ translate('rating') }}</li>
                                <li>{{ translate('price') }}</li>
                                <li>{{ translate('color_variant') }}</li>
                                @foreach ($attributes as $attribute)
                                <li>{{ ucwords(translate($attribute->name)) }}</li>
                                @endforeach
                            </ul>
                        </div>

                        @for ($i = 0; $i < 3; $i++)
                        <div class="compare-item m-h-220" >
                            <div class="compare-thumb position-relative">
                                <form  action="javascript:" class="position-relative search--group " method="GET">
                                    <input type="text" class="form-control" id="search_bar_input{{$i}}" onkeyup="global_search_for_compare_list{{ $i }}()"  name="" placeholder="{{ translate('search_by_name_or_category') }}">
                                    <input name="data_from" value="search" hidden>
                                    @if (isset($compare_lists[$i]))
                                        <input name="data_from" value="{{$compare_lists[$i]['id']}}" id="compare_id{{ $i }}" hidden>
                                    @endif
                                    <input name="page" value="1" hidden>
                                    <button type="submit" class="btn floating-icon"><i class="bi bi-search"></i></button>
                                </form>
                                <div class="search-result-box-compare-list{{$i}} compare-list-search-bar shadow"></div>


                                @if (isset($compare_lists[$i]))
                                <div class="easyzoom easyzoom--overlay mt-4 ">
                                    @php($image = $compare_lists[$i]->product['thumbnail'])
                                    <a href="{{\App\CPU\product_image_path('thumbnail') . '/' . $image}}">
                                        <img loading="lazy" src="{{\App\CPU\product_image_path('thumbnail') . '/' . $image}}"
                                            onerror="this.src='{{ theme_asset('assets/img/image-place-holder.png') }}'"   alt="img/products">
                                    </a>
                                </div>

                                <div class="text-end mt-2 text-underline text-center text-text-2 d-sm-none" type="button">
                                    <a href="javascript:" class="text-underline text-title route_alert_function"
                                    data-routename="{{ route('delete-compare-list',['id'=>$compare_lists[$i]['id']]) }}"
                                    data-message="{{ translate('want_to_remove_compare_list_product?') }}"
                                    data-typename="">
                                        {{ translate('remove') }}
                                    </a>
                                </div>

                                <div class="text-center mt-2">
                                    <a href="{{route('product',$compare_lists[$i]->product->slug)}}" class="text-title line-limit-1 font-semibold link_hover">
                                        {{ $compare_lists[$i]->product['name'] }}
                                    </a>
                                </div>
                                <div class="text-end mt-2 text-underline text-text-2 d-none d-sm-block" type="button">
                                    <a href="javascript:" class="text-underline text-title route_alert_function"
                                    data-routename="{{ route('delete-compare-list',['id'=>$compare_lists[$i]['id']]) }}"
                                    data-message="{{ translate('want_to_remove_compare_list_product?') }}"
                                    data-typename="">
                                        {{ translate('remove') }}
                                    </a>
                                </div>
                                @endif

                                @if (!isset($compare_lists[$i]))
                                <div class="text-center mt-4 w-100 aspect-1 d-flex justify-content-center align-items-center">
                                    <div class="text-center w-100 mt-4">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/compare-empty.svg') }}" alt="compare-empty">
                                        <p class="text-center pt-4 text-muted">{{ translate('no_products_added_yet') }}</p>
                                    </div>
                                </div>
                                @endif

                            </div>

                            @if (!isset($compare_lists[$i]))
                            <ul class="compare-info">
                                @if ($web_config['brand_setting'])
                                    <li>&nbsp;</li>
                                @endif
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                                <li>&nbsp;</li>
                                @foreach ($attributes as $attribute)
                                    <li>&nbsp;</li>
                                @endforeach
                            </ul>
                            @endif

                            @if (isset($compare_lists[$i]))
                            <ul class="compare-info">
                                @if ($web_config['brand_setting'])
                                    @if(isset($compare_lists[$i]->product->brand->name))
                                    <li>
                                        <a class="text-title link_hover" href="{{route('products',['id'=> $compare_lists[$i]->product->brand->id, 'data_from'=>'brand','page'=>1])}}">
                                            {{ $compare_lists[$i]->product->brand->name }}
                                        </a>
                                    </li>
                                    @endif
                                @endif

                                @if (isset($compare_lists[$i]->product->rating[$i]))
                                    <li>{{$compare_lists[$i]->product->rating[$i]->average}}</li>
                                @else
                                    <li>{{translate('no_rating')}}</li>
                                @endif
                                <li>{{ \App\CPU\currency_converter($compare_lists[$i]->product['unit_price']) }}</li>
                                @php($colors = json_decode($compare_lists[$i]->product->colors))

                                @if (count($colors)>0)
                                    <li>
                                        @foreach ($colors  as $key=>$value)
                                            {{ \App\CPU\get_color_name($value) }}
                                            @if ($key === array_key_last($colors))@break @endif
                                            ,
                                        @endforeach
                                    </li>
                                @else
                                    <li>{{translate('no_color_available')}}</li>
                                @endif
                                @foreach ($attributes as $attribute)
                                    @php($choice_options = json_decode($compare_lists[$i]->product->choice_options))
                                    @if ($choice_options )
                                        @foreach ($choice_options as $k => $choice)
                                            @if ($choice->title == $attribute->name )
                                                <li>
                                                    @foreach ($choice->options  as $key=>$value)
                                                         {{translate($value)}}
                                                         @if ($key === array_key_last($choice->options))@break @endif
                                                         ,
                                                    @endforeach
                                                </li>
                                            @elseif(count($choice_options)!= count($attributes))
                                                <li>{{ ucwords(translate('no_'.$attribute->name)) }}</li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>{{ ucwords(translate('no_'.$attribute->name)) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            @endif

                        </div>
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
