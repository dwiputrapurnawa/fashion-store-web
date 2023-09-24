$(function() {

    feather.replace();

    const currentYear = new Date().getFullYear();

    $(".copyright").html(`&copy; ${currentYear} Fashion Store, Inc`)


    $(".img-item").on("mouseover", function() {
        const selectedImgSrc = $(this).attr("src");

        $(".img-view").attr("src", selectedImgSrc);
    })

    $("#total").on("change", function() {
        const value = $(this).val();
        const price = $(".product-price").html()

        const subtotal = price * value;

        $(".subtotal").html("Rp. " + subtotal);
    })
})