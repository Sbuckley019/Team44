// Handle the preview when the button is clicked
$(document).ready(function () {
    $("#viewCardBtn").click(function () {
        // Fetch the data from the form to build the product card
        var productName = $("#product_name").val();
        var productDescription = $("#description").val();
        var productPrice = $("#price").val();
        var productImageUrl = $("#image_url").val();

        // Construct the product card HTML
        var productCardHTML = `
                <div class="product-card">
                    <img class="product-image" src="${productImageUrl}" alt="Product Image">
                    <div class="product-details">
                        <div class="product-name">${productName}</div>
                        <div class="product-description">${productDescription}</div>
                        <div class="product-price">£${productPrice}</div>
                        <div class="action-buttons">
                            <button class="favorite-btn"><i class="fas fa-heart"></i></button>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            `;

        // Inject the product card HTML into the modal
        $("#productCardPreview").html(productCardHTML);

        // Show the modal
        $("#productCardModal").show();
    });
});

// Function to close the modal
function closeProductCard() {
    $("#productCardModal").hide();
}

$(document).ready(function () {
    $(".reviewid").click(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var reviewId = $(this).attr("value");

        $.ajax({
            url: "/review/helpful",
            type: "POST",
            data: {
                _token: csrfToken,
                reviewId: reviewId,
            },
            success: function (response) {
                // Handle the response from the controller
                console.log(response);
            },
            error: function (xhr) {
                // Handle any errors
                console.error(xhr.responseText);
            },
        });

        var responseDiv = $("<div>")
            .addClass("review-response")
            .html(
                $("<i>").addClass("fas fa-check-circle").prop("outerHTML") +
                    "<div> Thank you for your feedback </div>"
            );

        $(this).replaceWith(responseDiv);
    });
});

$(document).ready(function () {
    const $carouselSlide = $(".carousel-slide");
    const $carouselItems = $(".carousel-object");
    const $prevButton = $(".prev-button");
    const $nextButton = $(".next-button");

    let counter = 0;

    // Get the width of the container
    const containerWidth = $(".carousel-container").width();
    // Get the width of a single product card including margin
    const itemWidth = $carouselItems.outerWidth(true); // Use outerWidth to include margin
    // Calculate the number of items visible at a time
    const visibleItems = 3;

    // Show the first set of items
    $carouselItems.slice(0, visibleItems).show();

    $nextButton.on("click", function () {
        if (counter >= $carouselItems.length - visibleItems) return;
        counter++;
        // Show the next set of items
        $carouselItems.slice(counter, counter + visibleItems).show();
        // Adjust the left property to shift the visible items
        $carouselSlide.animate({ left: -counter * itemWidth }, 420);
    });

    $prevButton.on("click", function () {
        if (counter <= 0) return;
        counter--;

        // Show the previous set of items
        $carouselItems.slice(counter, counter + visibleItems).show();
        // Adjust the left property to shift the visible items
        $carouselSlide.animate({ left: -counter * itemWidth }, 500);
    });
});

$(document).ready(function () {
    // Scroll to review section when shop-rating button is clicked
    var navbarHeight = 75;
    $("#shop-rating").click(function () {
        $("html, body").animate(
            {
                scrollTop: $("#review-section").offset().top - navbarHeight,
            },
            0
        );
    });

    // Copy URL to clipboard when shop-copy button is clicked
    $("#shop-copy").click(function () {
        var url = window.location.href;
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(url).select();
        document.execCommand("copy");
        tempInput.remove();
    });
});
