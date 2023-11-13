<div class="col-3 mb-4 d-flex align-items-stretch">
    <div class="card">
        <img class="card-img-top" src="{{ $product->cover }}" alt="{{ $product->title }}">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('catalog.show',['slug' => $product->slug]) }}">
                    {{ $product->title }}
                </a>
            </h5>
            <p>
                @foreach($product->categories as $category)
                    <a href="/public/category/show/{{ $category->slug }}">
                        <span class="badge
                        @if($category->id == 1)
                            purple
                            @elseif($category->id == 2)
                            blue
                            @elseif($category->id == 3)
                            red
                            @elseif($category->id == 4)
                            yellow
                            @elseif($category->id == 5)
                            lime
                            @elseif($category->id == 6)
                            cyan
                            @elseif($category->id == 7)
                            green
                        @endif
                            mr-1">{{ $category->name }}</span>
                    </a>
                @endforeach
            </p>
            <p>${{ $product->price }}</p>
            <p>Stock: {{ $product->stock }}</p>
            <p class="card-text">
                {{ Str::limit($product->description, 120, '...') }}
            </p>
        </div>
        <div class="card-footer" style="height: 68px;">
            <span class="bridge {{ $product->stock > 0 ? 'badge-success' : 'badge-danger' }}" style="line-height: 2.5;">
                {{ $product->stock > 0 ? 'on stock' : 'not on stock' }}
            </span>
            @if( $product->stock > 0 )
                <span class="float-right">
                <a href="{{ route('cart.add', ['productId' => $product->id]) }}"
                   class="btn btn-sm btn-outline-secondary waves-effect">
                     to cart <i class="fas fa-cart-arrow-down"></i>
                </a>
            </span>
            @else
                <span class="float-right">
                </span>

{{--            <span class="float-right">--}}
{{--                <a href="{{ $product->stock > 0 ? route('cart.add', ['productId' => $product->id]) : '#' }}"--}}
{{--                   class="btn btn-sm btn-outline-secondary waves-effect">--}}
{{--                    {{ $product->stock > 0 ? 'to cart' : 'out of stock' }} <i class="fas fa-cart-arrow-down"></i>--}}
{{--                </a>--}}
{{--            </span>--}}
            @endif
        </div>
    </div>
</div>
