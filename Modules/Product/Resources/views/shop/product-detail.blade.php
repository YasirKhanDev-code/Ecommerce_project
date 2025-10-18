@extends('layouts.master')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <!-- Product Image Carousel -->
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    @if($product->gallery)
                        @foreach(json_decode($product->gallery) as $image)
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <!-- ✅ Product Details -->
        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>



            

            <div class="d-flex mb-3 align-items-center">
                <div class="text-primary mr-2">
                    {{-- Dynamic stars --}}
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($avgRating))
                            <small class="fas fa-star"></small> {{-- full star --}}
                        @elseif ($i - $avgRating < 1)
                            <small class="fas fa-star-half-alt"></small> {{-- half star --}}
                        @else
                            <small class="far fa-star"></small> {{-- empty star --}}
                        @endif
                    @endfor
                </div>

                <small class="pt-1">
                    ({{ $totalReviews }} {{ Str::plural('Review', $totalReviews) }}) – {{ $avgRating }}/5
                </small>
            </div>
            

            <h3 class="font-weight-semi-bold mb-4">
                <span id="product-price">${{ $product->inventories->first()->price ?? $product->price }}</span>
            </h3>

            <p class="mb-4">{{ $product->description }}</p>

            

            <!-- Attributes (Color, Size, etc.) -->
            @foreach ($attributes as $attributeName => $values)
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">{{ $attributeName }}:</p>
                    <form>
                        @foreach ($values as $value)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio"
                                       class="custom-control-input variant-option"
                                       id="{{ $attributeName }}-{{ $value->id }}"
                                       name="{{ strtolower($attributeName) }}"
                                       value="{{ $value->id }}">
                                <label class="custom-control-label" for="{{ $attributeName }}-{{ $value->id }}">
                                    {{ $value->value }}
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
            @endforeach

            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary text-center" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button class="btn btn-primary px-3">
                    <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                </button>
                
            </div>
        </div>
        <!-- ✅ End Product Details -->
         
    </div>

    

    <!-- Product Description -->
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Review Section -->
<div class="mt-5">
    <!-- Button to toggle the form -->
    <button class="btn btn-outline-primary mb-3" id="toggleReviewForm">
        <i class="fa fa-comment"></i> Leave a Review
    </button>

    <!-- Hidden form -->
    <div id="reviewForm" style="display: none;">
        <h5 class="mt-4">Leave a Review</h5>
        <form action="{{ route('product.review.store', $product->slug) }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="rating">Rating:</label>
                <select name="rating" class="form-control" required>
                    <option value="">Select rating</option>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★</option>
                    <option value="3">★★★</option>
                    <option value="2">★★</option>
                    <option value="1">★</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="comment">Your Review:</label>
                <textarea name="comment" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="name">Your Name (optional):</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name">
            </div>

            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>

<!-- Toggle Script -->
<script>
    document.getElementById('toggleReviewForm').addEventListener('click', function () {
        const form = document.getElementById('reviewForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            this.textContent = 'Close Form';
        } else {
            form.style.display = 'none';
            this.innerHTML = '<i class="fa fa-comment"></i> Leave a Review';
        }
    });
</script>

    <!-- Related Products -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">You May Also Like</span>
        </h2>
        <div class="row px-xl-5">
            @foreach ($relatedProducts as $related)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $related->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>Rs. {{ $related->price }}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('shop.show', $related->slug) }}" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>View Detail
                            </a>
                            <a href="#" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Dynamic Price Update Script -->
<script>
    const inventories = @json($product->inventories);

    document.querySelectorAll('.variant-option').forEach(radio => {
        radio.addEventListener('change', updatePrice);
    });

    function updatePrice() {
        const selected = Array.from(document.querySelectorAll('.variant-option:checked')).map(el => el.value);

        // Match variant from inventory
        const match = inventories.find(inv => {
            const ids = inv.attribute_value_ids;
            return ids.length === selected.length && selected.every(id => ids.includes(id));
        });

        if (match) {
            document.getElementById('product-price').textContent = match.price;
        }
    }
</script>
@endsection
