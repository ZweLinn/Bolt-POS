@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Product List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Product List (Total: {{ $products->total() }})</h6>
                <form action="{{ route('product#list') }}" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" name="key" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                            value="{{ request('key') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('product#createPage') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Create Product
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (count($products) > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="col-1">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" class="img-thumbnail shadow-sm"
                                                    style="width: 100px;">
                                            @else
                                                <img src="{{ asset('admin/img/undraw_posting_photo.svg') }}"
                                                    alt="No Image" class="img-thumbnail shadow-sm" style="width: 100px;">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ number_format($product->price) }} MMK</td>
                                        <td>{{ $product->count }}</td>
                                        <td>
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-product-deletion-{{ $product->id }}')"
                                                class="btn btn-sm btn-outline-danger shadow-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </x-danger-button>

                                            <x-modal name="confirm-product-deletion-{{ $product->id }}" focusable>
                                                <form method="post" action="{{ route('product#delete', $product->id) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Are you sure you want to delete this product?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Once this product is deleted, all of its resources and data will be permanently deleted. (Product: ') . $product->name . ')' }}
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete Product') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5">
                            <h4 class="text-muted">No products found!</h4>
                        </div>
                    @endif
                </div>

                <div class="mt-3">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection