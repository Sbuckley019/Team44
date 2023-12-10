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
