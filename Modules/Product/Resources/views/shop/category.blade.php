@extends('product::layouts.master')
@section('title', $category->name . ' - Eshopper')

@section('content')
<!-- Category Page Start -->
<div class="container py-5">
    <!-- Page Title -->
    <div class="text-center mb-5">
        <h2 class="section-title px-5"><span class="px-2">{{ $category->name }}</span></h2>
        <p class="text-muted">Explore our latest {{ strtolower($category->name) }} collection below.</p>
    </div>

    <!-- Products Grid -->
    <div class="row px-xl-5">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="card product-item border-0 mb-4 shadow-sm">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
    <img
        class="img-fluid w-100 product-thumb"
        src="{{ $product->image
            ? asset('storage/' . $product->image)
            : asset('modules/product/img/default.png') }}"
        alt="{{ $product->name }}">
</div>

                    <div class="card-body border-left border-right text-center p-3">
                        <h6 class="text-truncate mb-2">{{ $product->name }}</h6>
                        @if($product->old_price)
                            <div class="d-flex justify-content-center">
                                <h6>Rs. {{ number_format($product->price, 2) }}</h6>
                                <h6 class="text-muted ml-2"><del>Rs. {{ number_format($product->old_price, 2) }}</del></h6>
                            </div>
                        @else
                            <h6>Rs. {{ number_format($product->price, 2) }}</h6>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>View Detail
                        </a>
                        <a href="#" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No products found in this category yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
<!-- Category Page End -->

@endsection

@push('styles')
<style>
    /* Product image fix */
    .product-thumb {
        height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-item:hover .product-thumb {
        transform: scale(1.05);
    }

    .product-item {
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .product-item .card-footer {
        border-top: none;
    }

    .section-title span {
        border-bottom: 2px solid #ff6f00;
    }
</style>
@endpush
