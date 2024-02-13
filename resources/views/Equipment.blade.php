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
                <img src="Weight-Set.webp" alt="Weight Set">
                <h3>Deluxe Weight Set</h3>
                <p>Start your home gym with our comprehensive weight set, suitable for all levels of fitness enthusiasts.</p>
                <p class="price">£299</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product" id="Treadmill">
                <img src="Treadmill-set.jpg" alt="Treadmill">
                <h3>Treadmill</h3>
                <p>Start your day with a nice jog on our exclusive treadmill.</p>
                <p class="price">£250</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product" id="Dumbbell Set">
                <img src="Dumbbell-set.jpg" alt="Dumbbell Set">
                <h3>Dumbbell Set</h3>
                <p>Our Dumbbell Set allows users like you to store your weights in one place.</p>
                <p class="price">£350</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product" id="Bench">
                <img src="Bench-set.jpg" alt="Bench">
                <h3>Bench</h3>
                <p>Our bench allow users to train comfortably.</p>
                <p class="price">£200</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product" id="Pull Up Bar">
                <img src="PullUpBar-set.jpg" alt="Pull Up Bar">
                <h3>Pull Up Bar</h3>
                <p>Our pull up bar is an easy to set up product that allows you get in your dream shape as soon as possiable.</p>
                <p class="price">£100</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>
           
        </section>
    </div>


    @include('includes.footer')
</body>
