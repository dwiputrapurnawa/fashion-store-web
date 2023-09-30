$(function() {

    feather.replace();

    const currentYear = new Date().getFullYear();

    const formatter = new Intl.NumberFormat("en-EN", {
        style: "currency",
        currency: "IDR"
    });


    $(".currency").each(function() {
        $(this).html(formatter.format($(this).html()));
    })

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

            var number = Number(price.replace(/[^0-9.-]+/g,""));

            const subtotal = number.toString() * quantityValue;

            $(".subtotal").eq(index).html(formatter.format(subtotal));

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

            var number = Number(price.replace(/[^0-9.-]+/g,""));

            const subtotal = number.toString() * quantityValue;

            $(".subtotal").eq(index).html(formatter.format(subtotal));
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
        loop:true,
        margin:10,
        autoHeight: true,
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
    })
      
})