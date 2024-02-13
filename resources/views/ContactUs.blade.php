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
            <form action="{{route('feedback.store')}}" method="POST" id="contactForm">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="Feedback">Message:</label>
                    <textarea class="form-control" id="Feedback" name="feedback" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </fieldset>
                </div>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
</body>