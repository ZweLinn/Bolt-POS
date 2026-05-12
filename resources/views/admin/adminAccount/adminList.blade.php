@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Admin List</h1>

        <div class="row">
            <div class="col-md-8">
                <!-- Admin list table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Admin List (Total: {{ $adminList->total() }})</h6>
                        <form action="{{ route('account#adminList') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                            @if (count($adminList) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Admin Name</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $adminList as $admin )
                                            <tr>
                                                <td>{{ $admin->id }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-outline-warning shadow-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="" class="btn btn-sm btn-outline-danger shadow-sm" title="Delete"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-5">
                                    <h4 class="text-muted">No admins found!</h4>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3">
                            {{ $adminList->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection