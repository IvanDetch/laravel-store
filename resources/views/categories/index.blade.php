@extends('categories.content')

@section('title')
    Category
@endsection

@section('content')
    <h1 align="center">@yield('title')</h1>
    <div class="container-fluid">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-3 mb-4 d-flex align-items-stretch">
                    <div class="card">
                        <img class="card-img-top" src="{{ $category->img}}" style="height: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/public/category/show/{{ $category->slug }}">{{ $category->name}}</a></h5>
                            <p class="card-text">{{ Str::limit($category->desc,120,'...')}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row align-content-center">
            <div class="container">
                <div class="col-4 offset-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
