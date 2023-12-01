<ul class="list-group list-group-flush border-0">
    @foreach($products as $product)
        <li class="list-group-item border-0">
            <a href="{{ route('store-compare-list',['product_id'=>$product['id'],'compare_id'=>$compare_id ]) }}" class="text-base">
                {{$product['name']}}
            </a>
        </li>
    @endforeach
</ul>
