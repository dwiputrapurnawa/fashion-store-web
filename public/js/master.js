$(function() {

    feather.replace();

    const currentYear = new Date().getFullYear();

    const totalPriceItem = $(".total-price-items").html();

    $(".total-price").html(totalPriceItem)

    const totalPrice = $(".total-price").html();

    $(".total-price-checkout").html(totalPrice);
    $(".total-price-items-checkout").html(totalPriceItem);

    $(".copyright").html(`&copy; ${currentYear} Fashion Store, Inc`)


    $(".img-item").on("mouseover", function() {
        const selectedImgSrc = $(this).attr("src");

        $(".img-view").attr("src", selectedImgSrc);
    })

    $(".plus-button").each(function(index){

        $(this).on("click", function() {
            
            var quantityValue = $("input[name='quantity']").eq(index).val();

            if(quantityValue < Number($(".stock").eq(index).html())) {
                quantityValue++;
            }

            $("input[name='quantity']").eq(index).val(quantityValue);

            var price = $(".product-price").eq(index).html()

            var number = price.replace(/[^0-9.-]+/g,"");

            const subtotal = number.substring(1) * quantityValue;
            const finalSubtotal = subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")


            $(".subtotal").eq(index).html("Rp. " + finalSubtotal);

        })

    });

    $(".minus-button").each(function(index) {
        $(this).on("click", function() {
            var quantityValue = $("input[name='quantity']").eq(index).val();

            if(quantityValue > 1) {
                quantityValue--;
            }

            $("input[name='quantity']").eq(index).val(quantityValue);

            var price = $(".product-price").eq(index).html()

            var number = price.replace(/[^0-9.-]+/g,"");

            const subtotal = number.substring(1) * quantityValue;
            const finalSubtotal = subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")


            $(".subtotal").eq(index).html("Rp. " + finalSubtotal);
        });
    });


    $(".plus-cart-button").each(function(index) {
        $(this).on("click", async function() {
            var quantityValue = $("input[name='quantity']").eq(index).val();

            if(quantityValue < Number($(".stock").eq(index).html())) {
                quantityValue++;
            }

            const cart_id = $("input[name='cart_id']").eq(index).val();

            const url = "/cart?quantity=" + quantityValue + "&cart_id=" + cart_id;
            const response = await fetch(url, {
                method: "PATCH",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const data = await response.json();

            console.log(data);

            location.replace(location.href.split('#')[0]);
        })
    });


    $(".minus-cart-button").each(function(index) {
        $(this).on("click", async function() {
            var quantityValue = $("input[name='quantity']").eq(index).val();

            if(quantityValue > 1) {
                quantityValue--;
            }

            const cart_id = $("input[name='cart_id']").eq(index).val();

            const url = "/cart?quantity=" + quantityValue + "&cart_id=" + cart_id;
            const response = await fetch(url, {
                method: "PATCH",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const data = await response.json();

            console.log(data);

            location.replace(location.href.split('#')[0]);
        })
    });

    $("#search-button").on("click", function() {
        const searchValue = $("input[name='search']").val();

        window.location.href = "/?search=" + searchValue + "#product-list"

    });

    $("input[name='search']").keydown(function(e) {
        
        if(e.keyCode == 13) {
            e.preventDefault();
            $("#search-button").click();
        }

    });

    $('.owl-carousel').owlCarousel({
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:4,
            }
        }
    });
    
    $("textarea[name='content']").each(function() {
        $(this).focus(function() {
            $(this).animate({
                height: "100px"
            })
        });

        $(this).focusout(function() {
            $(this).animate({
                height: "30px"
            })
        });
    });

    $("#cancelComment").on("click", function() {
        $("textarea[name='content']").val("");
    });

    $("#comment").on("change", function() {
        if($(this).val() == "") {
            $("#cancelComment").prop("disabled", true);
        } else {
            $("#cancelComment").prop("disabled", false);
        }
    });

    $("#shipping").on("change", function(e) {
        const value = e.target.value;
        const totalPrice = $(".total-price").html();
        const totalPriceNumber = totalPrice.replace(/[^0-9.-]+/g,"").substring(1);


        const totalPriceCalculate = Math.round(totalPriceNumber) + Number(value);
        const finalTotalPrice = totalPriceCalculate.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")

        const discountCoupon = parseFloat(value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")


        $(".shipping-price-container").removeClass("d-none")

        $(".shipping-price").html("Rp. " + discountCoupon)

        $(".total-price-checkout").html("Rp. " + finalTotalPrice)
        
    });

        $(".reedem-btn").on("click", async function() {
            const couponCode = $("input[name='coupon']").val();

            if(couponCode == "") {
                $(".coupon-container").addClass("d-none")
            } else {
                $(".coupon-container").removeClass("d-none")

                const url = "/coupon?coupon=" + couponCode;
        
                const response = await fetch(url, {
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
                const data = await response.json();

                if(data.data) {
                    const couponData = data.data;

                    const totalPriceItem = $(".total-price-items").html();
                    const totalPriceItemNumber = totalPriceItem.replace(/[^0-9.-]+/g,"").substring(1);

                    const shippingPrice = $(".shipping-price").html()
                    const shippingPriceNumber = shippingPrice.replace(/[^0-9.-]+/g,"").substring(1);


                    const totalPrice = Number(totalPriceItemNumber) - couponData.discount + Number(shippingPriceNumber);

                    console.log(totalPrice);

                    const finalTotalPrice = Number(totalPrice).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")

                    const discountCoupon = couponData.discount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    


                    $(".total-price").html("Rp. " + finalTotalPrice)
                    $(".coupon-code").html(couponCode);
                    $(".coupon-discount").html("Rp. " + discountCoupon);
                    $(".coupon-discount-checkout").html("Rp. " + discountCoupon);
                    $(".total-price-checkout").html("Rp. " + finalTotalPrice);
    
                } else {
                    $(".coupon-container").addClass("d-none")
                }

                
            }
            
        });

    
    $("#checkout-btn").on("click", function() {

        

        /*


        invoice_number
        user_id
        total_price
        payment_status
        order_status
        shipping_id
        tracking_number
        shipping_cost
        coupon_id


        */

    });
    
   

})