@include('includes.navigation')

<body>
    <div class="contact-container">
        <h1>Contact Us</h1>

        <div class="section-container contact-details">
            <p>Email: gains@gmail.com</p>
            <p>Phone: 01332 345475</p>
            <p>Address: 64 Striker Lane, Kensington, London, W8 4AB</p>
        </div>

        <div class="section-container user-input">
            <h2>Send us a message:</h2>
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rate">Rate us:</label>
                    <div class="rating-container">
                        <input type="radio" id="star5" name="rate" value="5">
                        <i class="fas fa-star"></i>
                        <input type="radio" id="star4" name="rate" value="4">
                        <i class="fas fa-star"></i>
                        <input type="radio" id="star3" name="rate" value="3">
                        <i class="fas fa-star"></i>
                        <input type="radio" id="star2" name="rate" value="2">
                        <i class="fas fa-star"></i>
                        <input type="radio" id="star1" name="rate" value="1">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <button type="button" class="btn-submit" onclick="submitForm()">Submit</button>
            </form>
        </div>
    </div>
</body>