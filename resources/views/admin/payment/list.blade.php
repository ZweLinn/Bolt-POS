@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Payment</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Payment Method</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment#create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="paymentMethod">Payment Method</label>
                                <input type="text" name="paymentMethod" id="paymentMethod" class="form-control @error('paymentMethod') is-invalid @enderror" placeholder="Enter payment method..." value="{{ old('paymentMethod') }}">
                                @error('paymentMethod')
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
                <!-- Payment method list table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Payment Method List (Total: {{ $payments->total() }})</h6> --}}
                        <form action="{{ route('payment#list') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                            @if (count($payments) > 0)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Payment Method</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $payments as $payment )
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->payment_method }}</td>
                                                <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('payment#edit', $payment->id) }}" class="btn btn-sm btn-outline-warning shadow-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('payment#delete', ['id' => $payment->id]) }}" class="btn btn-sm btn-outline-danger shadow-sm" title="Delete"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-5">
                                    <h4 class="text-muted">No payment methods found!</h4>
                                </div>
                            @endif
                        </div>

                        {{-- <div class="mt-3">
                            {{ $payments->appends(request()->query())->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection