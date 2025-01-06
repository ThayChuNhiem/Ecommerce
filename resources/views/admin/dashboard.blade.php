<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- product --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>List Product</h4>
                            <div class="card-header-form">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add Product</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Shop</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $product->name }}</td>
                                                <td class="align-middle">{{ $product->category->name }}</td>
                                                <td class="align-middle">{{ $product->description }}</td>
                                                <td class="align-middle"><img
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}" width="100"></td>
                                                <td class="align-middle">{{ $product->price }}</td>
                                                <td class="align-middle">{{ $product->shop->name }}</td>
                                                <td class="align-middle">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                            type="button" class="btn btn-secondary">Edit</a>
                                                        <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                                            type="button" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="8">Product not found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- category --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>List Category</h4>
                            <div class="card-header-form">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add Category</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $Category)
                                            <tr>
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $Category->name }}</td>
                                                <td class="align-middle">{{ $Category->description }}</td>
                                                <td class="align-middle"><img src="{{ asset('storage/' . $Category->image) }}" alt="{{ $Category->name }}" width="100"></td>
                                                <td class="align-middle">
                                                    @if ($Category->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td class="align-middle" style="width: 191px;">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('admin.category.edit', ['id' => $Category->id]) }}"
                                                            type="button" class="btn btn-secondary">Edit</a>
                                                        <a href="{{ route('admin.category.delete', ['id' => $Category->id]) }}"
                                                            type="button" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="6">Category not found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- discount --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>List Discounts</h4>
                            <div class="card-header-form">
                                <a href="{{ route('admin.discount.create') }}" class="btn btn-primary">Add Discount</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Discount Percentage</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($discounts as $discount)
                                            <tr>
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $discount->name }}</td>
                                                <td class="align-middle">{{ $discount->description }}</td>
                                                <td class="align-middle">{{ $discount->discount_percentage }}%</td>
                                                <td class="align-middle">{{ $discount->start_date }}</td>
                                                <td class="align-middle">{{ $discount->end_date }}</td>
                                                <td class="align-middle">
                                                    {{ $discount->category ? $discount->category->name : 'N/A' }}</td>
                                                <td class="align-middle">
                                                    {{ $discount->product ? $discount->product->name : 'N/A' }}</td>
                                                <td class="align-middle" style="width: 191px;">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('admin.discount.edit', ['id' => $discount->id]) }}"
                                                            type="button" class="btn btn-secondary">Edit</a>
                                                        <a href="{{ route('admin.discount.delete', ['id' => $discount->id]) }}"
                                                            type="button" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="9">Discount not found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- shop --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>List Shops</h4>
                            <div class="card-header-form">
                                <a href="{{ route('admin.shop.create') }}" class="btn btn-primary">Add Shop</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Owner</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($shops as $shop)
                                            <tr>
                                                <td class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $shop->name }}</td>
                                                <td class="align-middle">{{ $shop->address }}</td>
                                                <td class="align-middle">{{ $shop->phone }}</td>
                                                <td class="align-middle">{{ $shop->email }}</td>
                                                <td class="align-middle">{{ $shop->description }}</td>
                                                <td class="align-middle"><img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" width="100"></td>
                                                <td class="align-middle">
                                                    @if ($shop->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td class="align-middle">{{ $shop->owners->name }}</td>
                                                <td class="align-middle" style="width: 191px;">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('admin.shop.edit', ['id' => $shop->id]) }}"
                                                            type="button" class="btn btn-secondary">Edit</a>
                                                        <a href="{{ route('admin.shop.delete', ['id' => $shop->id]) }}"
                                                            type="button" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="10">Shop not found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
