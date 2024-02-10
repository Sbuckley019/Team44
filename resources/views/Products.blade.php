@include('includes.navigation')

<body>
    <div class="title-container">
        @if(isset($category_name))
        {{$category_name}}
        @else
        All Products
        @endif
    </div>
    <div class="project-page-container">
        <!--
    <div class="filter-container">
        <div class="filter-menu">
            <h1>Filter</h1>
            <form id="filterForm">
                <div class="filter-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category">
                        @foreach($categories as $choice)
                        <option value="{{$choice->id}}" {{ $choice->category_name == $category_name ? 'selected' : '' }} >{{$choice->category_name}}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="filter-group">
                    <label for="priceRange">Price Range:</label>
                    <div id="priceRangeSlider"></div>
                    <input type="range" name="priceRange" id="priceRange" min="0">
                    <input type="range" name="priceRange" id="priceRange" max="999">
                </div>

                <div class="filter-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating">
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div>
                <button type="button" class="apply-button" onclick="applyFilters()">Apply Filters</button>
            </form>
        </div>
                    -->

    </div>
    <div>
        <div class="search-container">
            <div class="w-50">
                <form action="{{route('products.search')}}" method="POST">
                    @csrf
                    <input class="searchbar w-80" type="text" placeholder="Search.." name="search">
                    @if(isset($category_name))
                    <input type="hidden" name="category_name" value="{{ $category_name}}">
                    @endif
                    <button class="searchbar" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!--<div class="sorting-container">
                <label for="sort">Sort by:</label>
                        <select id="sort" onchange="sortProducts()" class="sort-select" data-items="{{json_encode($products)}}">
                    <option value="priceHighToLow">Price (High to Low)</option>
                    <option value="priceLowToHigh">Price (Low to High)</option>
                    <option value="rating">Rating</option>
                    <option value="newest">Newest</option>
                </select>
            </div>-->
        </div>
        @if($products->isEmpty())
        <div class="register-msg">There are no Products that match the search criteria</div>
        @else
        <div class="products-container">
            @foreach ($products as $product)
            <a href="{{route('home')}}" class="product-card-link">
                <div class="product-card">
                    <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
                    <div class="product-details">
                        <div class="product-name">{{$product->product_name}}</div>
                        <div class="product-description">{{$product->description}}</div>
                        <div class="product-price">£{{$product->price}}</div>
                        @if(auth()->check())
                        <form action="{{route('favourite.add', ['productId' => $product->id]) }}" method="POST">
                            @csrf
                            <button class="fa-heart @if (in_array($product->id, $favouriteIds))filled @endif"></button>
                        </form>
                        @endif
                        <div class="action-buttons">
                            <div class="stars" style="--rating: {{($product->rating)/5 * 100}}%"></div>
                            <form action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        </div>
        @endif
    </div>
    </div>
    </div>
    @include('includes.footer')
</body>