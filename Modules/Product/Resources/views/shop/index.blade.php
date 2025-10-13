@extends('product::layouts.master')

@section('title', 'shop - My Ecommerce')

@section('content')
    
 <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
       <!-- Shop Sidebar Start -->
<div class="col-lg-3 col-md-12">
    <form method="GET" action="{{ route('shop') }}">

        <!-- Price Filter -->
        <div class="border-bottom mb-4 pb-4">
            <h5 class="font-weight-semi-bold mb-4">Filter by Price</h5>
            @php
                $priceRanges = [
                    '0-100' => '$0 - $100',
                    '100-200' => '$100 - $200',
                    '200-300' => '$200 - $300',
                    '300-400' => '$300 - $400',
                    '400-500' => '$400 - $500',
                ];
            @endphp

            @foreach($priceRanges as $key => $label)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input"
                           name="prices[]" value="{{ $key }}"
                           id="price-{{ $loop->index }}"
                           {{ in_array($key, $request->prices ?? []) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="price-{{ $loop->index }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>

        <!-- Attribute Filters -->
        @foreach($attributes as $attribute)
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by {{ $attribute->name }}</h5>
                @foreach($attribute->values as $value)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input"
                               name="attributes[{{ $attribute->id }}][]"
                               value="{{ $value->id }}"
                               id="attr-{{ $attribute->id }}-{{ $value->id }}"
                               {{ in_array($value->id, $request->input('attributes.' . $attribute->id, [])) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="attr-{{ $attribute->id }}-{{ $value->id }}">
                            {{ $value->value }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-2 w-100">Apply Filters</button>
    </form>
</div>
<!-- Shop Sidebar End -->



            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  @foreach($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>{{$product->price}}</h6>
                    <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
            </div>
        </div>
    </div>
@endforeach

                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    
@endsection