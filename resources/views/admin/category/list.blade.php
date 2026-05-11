@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category#create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName">Name</label>
                                <input type="text" name="categoryName" id="categoryName" class="form-control @error('categoryName') is-invalid @enderror" placeholder="Enter category name..." value="{{ old('categoryName') }}">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-plus mr-1"></i> Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Category list table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Category List (Total: {{ $categories->total() }})</h6>
                        <form action="{{ route('category#list') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" name="key" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2" value="{{ request('key') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (count($categories) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $categories as $category )
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('category#edit', $category->id) }}" class="btn btn-sm btn-outline-warning shadow-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('category#delete', ['id' => $category->id]) }}" class="btn btn-sm btn-outline-danger shadow-sm" title="Delete"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-5">
                                    <h4 class="text-muted">No categories found!</h4>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3">
                            {{ $categories->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection