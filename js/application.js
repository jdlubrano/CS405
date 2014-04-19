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
            dataType: "html",
            success: function() {
                location.reload();
            },
            error: function(msg) {
                alert("Failed to add item to cart: " + JSON.stringify(msg));
                console.log(msg);
            }
        });
    });
    $('.updateInvButton').click(function() {
        var itemId = $(this).attr("item");
        var quantity = $('#quantityInput' + itemId).val();
        $.ajax({
            method: "GET",
            url: 'updateItem.php',
            data: 'item_id='+itemId+'&quantity='+quantity,
            dataType: "html",
            success: function(msg) {
                alert("Successfully Updated Inventory!");
                location.reload();
            },
            error: function(msg) {
                alert(JSON.stringify(msg));
            }
        })
    });
    $('.shipOrderButton').click(function() {
        var orderId = $(this).attr("order");
        var url = "shipOrder.php?order_id="+orderId;
        $.ajax({
            method: "GET",
            url: url,
            dataType: "html",
            success: function(msg) {
                alert(msg);
                location.reload();
            },
            error: function(msg) {
                alert(JSON.stringify(msg));
            }
        })
    });
    $('#startPromoBtn').click(function() {
        var form = $('form').serialize();
        $.ajax({
            method: "POST",
            url: 'createPromotion.php',
            data: form,
            success: function(msg) {
                alert("Successfully started promotion.");
                location.href = "viewPromotionHistory.php"
            },
            error: function(msg) {
                alert(JSON.stringify(msg));
            }
        })
    });
    $('.stopPromoBtn').click(function() {
        var promoId = $(this).attr("promo");
        $.ajax({
            method: "GET",
            url: "stopPromotion.php",
            data: "promotion_id="+promoId,
            success: function(msg) {
                alert(msg);
                location.reload();
            },
            error: function(msg) {
                alert(JSON.stringify(msg));
            }
        })
    })
});
