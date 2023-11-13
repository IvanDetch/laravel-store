@extends('categories.content')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 style="text-align: center;">{{ $category->name}}</h1>
        <div class="content">Колличество товаров в данной категории: <span>{{$category->products->count()}}</span></div>
        <div class="sorting_container ml-md-auto" style="display: table;">
            <div class="sorting">
                <ul class="item_sorting">
                    <li>
                        <span class="sorting-text">Sort by</span>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <ul>
                            <li class="product_sorting_btn" data-order="default"><span>Default</span></li>
                            <li class="product_sorting_btn" data-order="price-low-high"><span>Price: Low-High</span></li>
                            <li class="product_sorting_btn" data-order="price-high-low"><span>Price: High-Low</span></li>
                            <li class="product_sorting_btn" data-order="name-a-z"><span>Name: A-Z</span></li>
                            <li class="product_sorting_btn" data-order="name-z-a"><span>Name: Z-A</span></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
{{--        <select name="country_id">--}}
{{--            <option disabled selected>Выберите страну...</option>--}}
{{--            @foreach ($countries as $country)--}}
{{--                <option value="{{ $country->id }}">{{ $country->name }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
        <div class="row">
            @foreach($products as $product)
                @include('catalog.card',compact('product'))
            @endforeach
        </div>

        <div class="align-content-center" style="margin-right: -15px; margin-left: -15px; display: flex;flex-wrap: wrap;">
            <div>
                <div class="pag-link col-4 offset-1">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order');
                {{--let page = "{{ isset($_GET['page']) ? $_GET['page'] : 1 }}";--}}
                $('.sorting-text').text($(this).find('span').text())

                $.ajax({
                    url: "{{route('categories.show',$category->slug)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                        page: {{ isset($_GET['page']) ? $_GET['page'] : 1 }},
                    },
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters, location.pathname.length);
                        let newURL = url + '?'; // http://laravel-store.test:8080/public/category/show/phones?
                        newURL += "&page={{ isset($_GET['page']) ? $_GET['page'] : 1 }}" + 'orderBy=' + orderBy; // http://laravel-store.test:8080/public/category/show/phones?orderBy=price-low-high
                        history.pushState({}, '', newURL);

                        $('.pagination .page-item a').each(function(index, value){
                            let link= $(this).attr('href')
                            $(this).attr('href',link+'&orderBy='+orderBy)
                        })

                        $('.row').html(data)
                        // console.log(data)
                    }
                })
            })
        })
    </script>
@endsection
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            $('.product_sorting_btn').click(function () {--}}
{{--                let orderBy = $(this).data('order')--}}

{{--                $.ajax({--}}
{{--                   url: "{{route('categories.show',$category->slug)}}",--}}
{{--                   type: "GET",--}}
{{--                   data:{--}}
{{--                       orderBy: orderBy--}}
{{--                   },--}}
{{--                    header:{--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                   success: (data) => {--}}
{{--                       console.log(data)--}}
{{--                   }--}}
{{--                   // dataType: dataType--}}
{{--                });--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--@endsection--}}
