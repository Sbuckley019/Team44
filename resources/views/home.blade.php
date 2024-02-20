@include('includes.navigation')

<body>
    @if(isset($total))
    <div>{{$total}}</div>
    <div>gap</div>
    @else
    <div class="hero-container">
        <a href="{{ route('products.index',['id'=>1])}}" class="hero-column" id="hero-img1">
            <div class="overlay-link">Mens</div>
        </a>
        <a href="{{ route('products.index',['id'=>2])}}" class="hero-column" id="hero-img2">
            <div class="overlay-link">Womens</div>
        </a>
    </div>
    <div class="hero-subcategories">
        <a href="{{ route('products.index',['id'=>3])}}" class="hero-sub">Shoes</a>
        <a href="{{ route('products.index',['id'=>4])}}" class="hero-sub">Accessories</a>
        <a href="{{ route('products.index',['id'=>5])}}" class="hero-sub">Supplements</a>
    </div>
    <div class="fixed-bottom mx-3 mb-3">
        @if(Session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 400px; margin: 0 auto;">
            {!! session()->get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    @include('includes.footer')
    @endif
</body>