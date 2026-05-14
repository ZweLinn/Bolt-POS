@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Payment Method</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Payment Method Info</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment#update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="paymentId" value="{{ $payment->id }}">
                            
                            <div class="form-group">
                                <label for="paymentMethod">Payment Method</label>
                                <input type="text" name="paymentMethod" id="paymentMethod" 
                                    class="form-control @error('paymentMethod') is-invalid @enderror" 
                                    placeholder="Enter payment method..." 
                                    value="{{ old('paymentMethod', $payment->payment_method) }}">
                                @error('paymentMethod')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('payment#list') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
