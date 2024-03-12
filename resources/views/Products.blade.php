@include('includes.navigation')

<body>
    <div class="title-container">
        @if(isset($category))
        <div>{{$category->category_name}}</div>
        @else
        All Products
        @endif
    </div>
    <div class="project-page-container">
        <div class="filter-container">
            <div class="filter-menu">
                <h1>Filter</h1>
                <form method="GET" action="{{route('products.index')}}" id="filterForm">
                    <div class="filter-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category">
                            <option value="{{null}}" {{$category ?? 'selected'}}> all products</option>
                            @foreach($categories as $choice)
                            <option value="{{$choice->id}}" {{$category !=null && $category->category_name == $choice->category_name ? 'selected' : '' }}>{{$choice->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="priceRange">Price Range:</label>
                        <input type="range" name="priceRangeMin" id="priceRange" min="0">
                        <input type="range" name="priceRangeMax" id="priceRange" max="999">
                    </div>

                    <div class="filter-group">
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating">
                            <option value="1">1+ star</option>
                            <option value="2">2+ stars</option>
                            <option value="3">3+ stars</option>
                            <option value="4">4+ stars</option>
                        </select>
                    </div>
                    <button type="submit" class="apply-button">Apply Filters</button>
                </form>
            </div>


        </div>
        <div>
            <div class="search-container">
                <div class="w-50">
                    <form action="{{route('products.index')}}" method="GET">
                        @csrf
                        <input class="searchbar w-80" type="text" placeholder="Search.." name="search">
                        @if(isset($category->id))
                        <input type="hidden" name="id" value="{{ $category->id}}">
                        @endif
                        <button class="searchbar" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="sorting-container">
                    <form method="GET" action="{{route('products.index')}}">
                        <label for="sort">Sort by:</label>
                        <select name="sortChoice" id="sort" onchange="this.form.submit()" class="sort-select">
                            <option value="1" {{ ($sortChoice ?? '4') == '1' ? 'selected' : '' }}>Price (High to Low)</option>
                            <option value="2" {{ ($sortChoice ?? '4') == '2' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="3" {{ ($sortChoice ?? '4') == '3' ? 'selected' : '' }}>Rating</option>
                            <option value="4" {{ ($sortChoice ?? '4') == '4' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </form>
                </div>
            </div>
            @if($products->isEmpty())
            <div class="register-msg">There are no Products that match the search criteria</div>
            @else
            <div class="products-container">
                @foreach ($products as $product)
                <a href="{{route('products.show', $product)}}" class="product-card-link">
                    <div class="product-card">
                        <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
                        
                        <div class="product-details">
                            <div class="product-name">{{$product->product_name}}</div>
                            <div class="product-description">{{$product->description}}</div>
                            <div class="product-price">£{{$product->price}}</div>
                            @if(auth()->check())
                            <form action="{{route('favourite.add', ['productId' => $product->id]) }}" method="POST">
                                @csrf
                                <button class="fav-button">
                                    <i class="fa-heart {{ in_array($product->id, $favouriteIds) ? 'fas' : 'far' }}"></i>
                                </button>
                            </form>
                            @endif
                            <div class="action-buttons">
                                <div class="stars" style="--rating: {{($product->rating)/5 * 100}}%"></div>
                                <form id="addToBasketForm" action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="add-to-cart-btn" onclick="addToBasket()">Add to Cart</button>
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