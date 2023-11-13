@extends('admin.content')

@section('title') Gallery @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
                <div class="card-tools">
                    {{ $galleries->links() }}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Gallery ID</th>
                        <th>Path</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->getKey() }}</td>
                                <td>{{ $gallery->gallery_id }}</td>
                                <td>{{ $gallery->path }}</td>
                                <td>{{ $gallery->created_at }}</td>
                                <td>{{ $gallery->updated_at }}</td>
{{--                                <td>--}}
{{--                                    <div class="btn-group">--}}
{{--                                        <a href="{{ route('admin.products.edit', ['product' => $product->getKey()]) }}" class="btn btn-warning">Edit</a>--}}
{{--                                        <a href="{{ route('admin.products.delete', ['product' => $product->getKey()]) }}" class="btn btn-danger">Delete</a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
