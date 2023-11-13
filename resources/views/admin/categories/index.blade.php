@extends('admin.content')

@section('title') Category @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    {{ $categories->links() }}
                    <div class="mt-2">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->getKey() }}</td>
                            <td>{{ $category->name}}</td>
                            <td>{{ $category->desc}}</td>
                            <td>{{ $category->img}}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->getKey()]) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.categories.delete', ['category' => $category->getKey()]) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    @if(count($trashedCategories) > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('title') | Trashed</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashedCategories as $trashedCategory)
                            @canany(['can-categoryDestroy', 'can-categoryRestore'], $trashedCategory)
                                <tr>
                                    <td>{{ $trashedCategory->getKey() }}</td>
                                    <td>{{ $trashedCategory->name }}</td>
                                    <td>{{ $trashedCategory->desc }}</td>
                                    <td>{{ $trashedCategory->img }}</td>
                                    <td>{{ $trashedCategory->created_at }}</td>
                                    <td>{{ $trashedCategory->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{--                                            @if(auth()->user()->is_admin)--}}
                                            <a href="{{ route('admin.categories.restore', ['category' => $trashedCategory->getKey()]) }}" class="btn btn-warning">Restore</a>
                                            <a href="{{ route('admin.categories.destroy', ['category' => $trashedCategory->getKey()]) }}" class="btn btn-danger">DROP</a>
                                            {{--                                            @endif--}}
                                        </div>
                                    </td>
                                </tr>
                            @endcanany
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif
@endsection
