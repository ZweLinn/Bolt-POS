@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Category Info</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category#update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="categoryId" value="{{ $category->id }}">
                            
                            <div class="form-group">
                                <label for="categoryName">Name</label>
                                <input type="text" name="categoryName" id="categoryName" 
                                    class="form-control @error('categoryName') is-invalid @enderror" 
                                    placeholder="Enter category name..." 
                                    value="{{ old('categoryName', $category->name) }}">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('category#list') }}" class="btn btn-secondary">
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
