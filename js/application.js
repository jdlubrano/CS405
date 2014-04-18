/**
 * Created by Joel on 4/16/14.
 */
$(function() {
    $('.removeFromCartLink').click(function() {
        $.ajax({
            method: "GET",
            url: $(this).attr("url"),
            success: function() {
                location.reload();
            },
            error: function() {
                alert("Failed to remove item from cart.")
            }
        });
    });
    $('.addToCartLink').click(function() {
        $.ajax({
            method: "GET",
            url: $(this).attr("url"),
            success: function() {
                location.reload();
            },
            error: function() {
                alert("Failed to add item to cart.");
            }
        });
    });
});
