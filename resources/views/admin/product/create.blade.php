@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
                        <a href="{{ route('category#list') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold text-dark">Product Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter product name...">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="font-weight-bold text-dark">Category</label>
                                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}" {{ old('category') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="font-weight-bold text-dark">Price (MMK)</label>
                                        <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                            class="form-control @error('price') is-invalid @enderror" placeholder="0.00">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="count" class="font-weight-bold text-dark">Stock Count</label>
                                        <input type="number" name="count" id="count" value="{{ old('count') }}" 
                                            class="form-control @error('count') is-invalid @enderror" placeholder="Enter quantity...">
                                        @error('count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-weight-bold text-dark">Description</label>
                                <textarea name="description" id="description" rows="4" 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    placeholder="Write product description here...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Product Image</label>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center p-4">
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('admin/img/undraw_posting_photo.svg') }}" id="output"
                                                class="img-thumbnail shadow-sm border"
                                                style="width: 220px; height: 220px; object-fit: cover;">
                                            <label for="image" class="position-absolute bottom-0 end-0 mb-1 me-1 btn btn-sm btn-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px; cursor: pointer;">
                                                <i class="fas fa-camera" style="font-size: 14px;"></i>
                                            </label>
                                        </div>
                                        <div class="mt-3">
                                            <div class="custom-file text-start">
                                                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" onchange="loadFile(event)">
                                                <label class="custom-file-label" for="image">Choose file...</label>
                                            </div>
                                            @error('image')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="reset" class="btn btn-light px-4 mr-2">Reset</button>
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-save mr-2"></i> Create Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Display filename and handle preview
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);

            // Update label
            let fileName = event.target.files[0].name;
            $(event.target).next('.custom-file-label').addClass("selected").html(fileName);
        };

        // Reset preview image on form reset
        $('button[type="reset"]').on('click', function() {
            $('#output').attr('src', '{{ asset("admin/img/undraw_posting_photo.svg") }}');
            $('.custom-file-label').removeClass("selected").html("Choose file...");
        });
    </script>
@endsection