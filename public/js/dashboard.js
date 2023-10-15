$(function() {
    var productTable = $("#product-table").DataTable({
        select: {
            style: 'single'
          },
        dom: 'Bftipr',
        buttons: [
            {
                text: "<i class='fa-solid fa-plus'></i> Add",
                className: "btn-dark",
                action: function() {
                    window.location.href = "/dashboard/products/create"
                }
            },
            {
                extend: 'selected',
                className: "btn-dark",
                text: "<i class='fa-solid fa-trash'></i> Delete",
                action: function ( e, dt, node, config ) {
                    const rows = dt.rows( { selected: true } ).data();
                    const productId = rows[0][rows[0].length - 1];

                    $("#deleteProductModal" + productId).modal("show");





                    // if(confirm("Are you sure?")) {
                    //     var rows = dt.rows( { selected: true } ).data();
                    //     var productIds = [];
                        
                    //     for (let index = 0; index < rows.length; index++) {
                            
                    //         productIds.push(rows[index][rows[index].length - 1]);
                            
                    //     }
    
                    //     const url = "/product";
                    //     const response = await fetch(url, {
                    //         method: "DELETE",
                    //         headers: {
                    //             "Content-Type": "application/json",
                    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //         },
                    //         body: JSON.stringify(productIds)
                    //     });
    
                    //     const data = await response.json();
    
                    //     console.log(data);
    
                    //     location.replace(location.href.split('#')[0]);
                    // }
                }
            },
            {
                extend: "selected",
                className: "btn-dark",
                text: "<i class='fa-solid fa-pen-to-square'></i> Edit",
                action: function(e, dt, node, config) {
                    e.preventDefault()
                    var rows = dt.rows( { selected: true } ).data();
                    var productSlugs = [];

                    for (let index = 0; index < rows.length; index++) {
                        productSlugs.push(rows[index][rows[index].length - 2]);            
                    }

                    productSlugs.forEach(slug => {
                        window.open("/dashboard/products/" + slug + "/edit", "_blank");
                    });
                }
            },
            {
                extend: "selected",
                className: "btn-dark",
                text: "<i class='fa-solid fa-info'></i> Show",
                action: function(e, dt, node, config) {
                    e.preventDefault()
                    var rows = dt.rows( { selected: true } ).data();
                    var productSlugs = [];

                    for (let index = 0; index < rows.length; index++) {
                        productSlugs.push(rows[index][rows[index].length - 2]);            
                    }

                    productSlugs.forEach(slug => {
                        window.open("/dashboard/products/" + slug, "_blank");
                    });
                }
            },
            {
                extend: "selected",
                className: "btn-dark",
                text: "<i class='fa-solid fa-tag'></i> Discount",
                action: function(e, dt, node, config) {

                    var productIds = [];

                    $("#discountModal").modal("show");

                    const rows = dt.rows({ selected: true }).data();

                    for (let index = 0; index < rows.length; index++) {
                        productIds.push(rows[index][rows[index].length - 1]);
                    }

                    $("input[name='productIds[]']").val(productIds);

                }  
            },
            // {
            //     extend: "excel",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-excel'></i> Export To Excel"
            // },
            // {
            //     extend: "csv",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-csv'></i> Export To CSV"
            // },
            // {
            //     extend: "pdf",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-pdf'></i> Export To PDF"
            // },
            // {
            //     extend: "print",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-print'></i> Print"
            // }
        ],
        select: true,
    });

    productTable.buttons().container().appendTo( $('.col-sm-6:eq(0)', productTable.table().container() ) );

    productTable.rows( { selected: true, page: "current" } ).nodes();


    var orderTable = $("#order-table").DataTable({
        dom: 'Bftipr',
        buttons: [
            // {
            //     extend: "excel",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-excel'></i> Export To Excel"
            // },
            // {
            //     extend: "csv",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-csv'></i> Export To CSV"
            // },
            // {
            //     extend: "pdf",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-file-pdf'></i> Export To PDF"
            // },
            // {
            //     extend: "print",
            //     className: "btn-dark",
            //     text: "<i class='fa-solid fa-print'></i> Print"
            // },
            {
                extend: "selected",
                className: "btn-dark",
                text: "<i class='fa-solid fa-circle-info'></i> Detail Order",
                action: function(e, dt, node, config) {
                    var rows = dt.rows({ selected:true }).data();
                    var selectedOrderId = rows[0][rows[0].length - 1];

                    $("#detailOrder" + selectedOrderId).modal("show");
                }
            },
            {
                extend: "selected",
                className: "btn-dark",
                text: "<i class='fa-solid fa-pen-to-square'></i> Edit",
                action: function(e, dt, node, config) {
                    const rows = dt.rows({ selected: true }).data();
                    const selectedOrderId = rows[0][rows[0].length - 1];

                    $("#editModal" + selectedOrderId).modal("show");
                }
            }
        ],
        select: true,
    });

    orderTable.buttons().container().appendTo( $('.col-sm-6:eq(0)', orderTable.table().container() ) );

    orderTable.rows( { selected: true, page: "current" } ).nodes();


    var customerTable = $("#customer-table").DataTable({
        dom: 'Bftipr',
        buttons: [
            {
                text: "<i class='fa-solid fa-plus'></i> Add",
                className: "btn-dark",
                action: function() {
                    $("#addUserModal").modal("show");
                }
            },
            {
                extend: "selected",
                text: "<i class='fa-solid fa-pen-to-square'></i> Edit",
                className: "btn-dark",
                action: function(e, dt, node, config) {
                    const rows = dt.rows( { selected: true } ).data();
                    const userId = rows[0][rows[0].length - 1];

                    $("#editUserModal" + userId).modal("show");
                }
            },
            {
                extend: "selected",
                text: "<i class='fa-solid fa-trash'></i> Delete",
                className: "btn-dark",
                action: function(e, dt, node, config) {
                    const rows = dt.rows( { selected: true } ).data();
                    const userId = rows[0][rows[0].length - 1];

                    console.log(userId);

                    $("#deleteUserModal" + userId).modal("show");
                }
            }
        ],
        select: true,
    });

    customerTable.buttons().container().appendTo( $('.col-sm-6:eq(0)', customerTable.table().container() ) );

    customerTable.rows( { selected: true, page: "current" } ).nodes();


    $(".img-item").on("mouseover", function() {
        const selectedImgSrc = $(this).attr("src");

        $(".img-view").attr("src", selectedImgSrc);
    })  

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed', "Table"],
        } )
        .catch( error => {
            console.error( error );
        } ); 
    

    $("#uploadImages").on("change", function(e) {

        $("#preview-img-container").empty();

        for (let index = 0; index < e.target.files.length; index++) {
            $("#preview-img-container").append(`<div class='col-sm-auto mb-3'> <img class='img-fluid img-thumbnail preview-img highlight' width='200px' height='200px' src='${URL.createObjectURL(e.target.files[index])}'></div>`)
            
        }

    });

    $(".clipboard-btn").on("click", function() {
        const trackingNumber = $(".tracking-number").html();

        navigator.clipboard.writeText(trackingNumber).then(() => {
            console.log(`Copied "${trackingNumber}" to clipboard`);

            $(this).attr("data-bs-title", "Copied to clipboard!")

            $(this).tooltip("show");


        }).catch((err) => {
            console.error('Could not copy text: ', err);
        });
    });

    $("select[name='order_status']").on("change", function(e) {
        const orderStatus = e.target.value;

        if(orderStatus == "sent") {
            $("input[name='tracking_number']").attr("disabled", false);
        } else {
            $("input[name='tracking_number']").attr("disabled", true);
        }
    })
})