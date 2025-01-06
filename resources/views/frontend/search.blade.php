<!-- resources/views/frontend/search.blade.php -->
@extends('backend.masterpage')

@section('title', 'Search Results')

@section('content')
<div class="py-12">
    <div class="container" style="margin-top: 152px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($products->isEmpty())
                    <div class="alert alert-warning">
                        No products found for query "{{ $query }}"
                    </div>
                @else
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $product->name }}" style="width: 306px; height: 306px; object-fit: cover;">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $product->category->name }}</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $product->name }}</h4>
                                        <p>{{ $product->description }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }} đ</p>
                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection