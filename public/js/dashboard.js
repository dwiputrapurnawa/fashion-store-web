$(function() {
    var table = $("table").DataTable({
        dom: 'Bftipr',
        buttons: [
            {
                text: "<i class='fa-solid fa-plus'></i> Add",
                action: function() {
                    window.location.href = "/dashboard/products/create"
                }
            },
            {
                extend: 'selected',
                text: "<i class='fa-solid fa-trash'></i> Delete",
                action: async function ( e, dt, node, config ) {
                    if(confirm("Are you sure?")) {
                        var rows = dt.rows( { selected: true } ).data();
                        var productIds = [];
                        
                        for (let index = 0; index < rows.length; index++) {
                            
                            productIds.push(rows[index][rows[index].length - 1]);
                            
                        }
    
                        const url = "/product";
                        const response = await fetch(url, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify(productIds)
                        });
    
                        const data = await response.json();
    
                        console.log(data);
    
                        location.replace(location.href.split('#')[0]);
                    }
                }
            },
            {
                extend: "selected",
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
                extend: "excel",
                text: "<i class='fa-solid fa-file-excel'></i> Export To Excel"
            },
            {
                extend: "csv",
                text: "<i class='fa-solid fa-file-csv'></i> Export To CSV"
            },
            {
                extend: "pdf",
                text: "<i class='fa-solid fa-file-pdf'></i> Export To PDF"
            },
            {
                extend: "print",
                text: "<i class='fa-solid fa-print'></i> Print"
            }
        ],
        select: true,
    });

    table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

    table.rows( { selected: true, page: "current" } ).nodes();

    const formatter = new Intl.NumberFormat("en-EN", {
        style: "currency",
        currency: "IDR"
    });

    $(".currency").each(function() {
        $(this).html(formatter.format($(this).html()));
    });

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
})