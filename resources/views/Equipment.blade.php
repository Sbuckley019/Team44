@include('includes.navigation')
<body>
    <div class="container">
        <!-- Featured Equipment Section -->
        <section class="featured-equipment">
            <h2>Featured Equipment</h2>
           
        </section>

        <!-- Categories Section -->
        <section class="categories">
            <h2>Categories</h2>
            <nav>
                <ul>
                    <li><a href="#weights">Weights</a></li>
                    <li><a href="#cardio">Cardio Machines</a></li>
                    <li><a href="#accessories">Accessories</a></li>
                </ul>
            </nav>
        </section>

        <!-- Product List Section -->
        <section class="product-list">
            <h2>Our Products</h2>
            <!-- Product Item -->
            <div class="product" id="weights">
                <img src="weight-set.jpg" alt="Weight Set">
                <h3>Deluxe Weight Set</h3>
                <p>Start your home gym with our comprehensive weight set, suitable for all levels of fitness enthusiasts.</p>
                <p class="price">$299</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>
           
        </section>
    </div>


    @include('includes.footer')
</body>
