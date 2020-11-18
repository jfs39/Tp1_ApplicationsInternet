
// Update the products data list
function getProducts() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
                function (data) {
                    var productsTable = $('#productData');
                    productsTable.empty();
                    $.each(data.products, function (key, value)
                    {
                        var editDeleteButtons = '</td><td>' +
                                '<a href="javascript:void(0);" class="btn btn-warning" rowID="' +
                                    value.id + 
                                    '" data-type="edit" data-toggle="modal" data-target="#modalProductsAddEdit">' + 
                                    'edit</a>' +
                                '<a href="javascript:void(0);" class="btn btn-danger"' +
                                    'onclick="return confirm(\'Are you sure to delete data?\') ?' + 
                                    'productAction(\'delete\', \'' + 
                                    value.id + 
                                    '\') : false;">delete</a>' +
                                '</td></tr>';
                        productsTable.append('<tr><td>' + value.id + '</td><td>' + value.product_name + '</td><td>' + value.product_description +'</td><td>'+ value.price + '</td><td>'+ value.other_details + editDeleteButtons);
 
                    });

                }
    });
}

 /* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}


function productAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var productData = '';
    var ajaxUrl = urlToRestApi;
    frmElement = $("#modalProductsAddEdit");
    if (type == 'add') {
        requestType = 'POST';
        productData = convertFormToJSON(frmElement.find('form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        ajaxUrl = ajaxUrl + "/" + id;
        productData = convertFormToJSON(frmElement.find('form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    frmElement.find('.statusMsg').html('');
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(productData),
        success: function (msg) {
            if (msg) {
                frmElement.find('.statusMsg').html('<p class="alert alert-success">Product data has been ' + statusArr[type] + ' successfully.</p>');
                getProducts();
                if (type == 'add') {
                    frmElement.find('form')[0].reset();
                }
            } else {
                frmElement.find('.statusMsg').html('<p class="alert alert-danger">Some problem occurred, please try again.</p>');
            }
        }
    });
}

// Fill the product's data in the edit form TODO REVENIR ICI SI BUG OCCURE
function editProduct(id) {
    $.ajax({
        type: 'GET',
        url: urlToRestApi + "/" + id,
        dataType: 'JSON',
       // data: 'action_type=data&id=' + id,
        success: function (data) {
            $('#id').val(data.product.id);
            $('#product_name').val(data.product.product_name);
            $('#product_description').val(data.product.product_description);
            $('#price').val(data.product.price);
            $('#other_details').val(data.product.other_details);
        }
    });
}

// Actions on modal show and hidden events
$(function () {
    $('#modalProductsAddEdit').on('show.bs.modal', function (e) {
        var type = $(e.relatedTarget).attr('data-type');
        var productFunc = "productAction('add');";
        $('.modal-title').html('Add new product');
        if (type == 'edit') {
            var rowId = $(e.relatedTarget).attr('rowID');
            productFunc = "productAction('edit',"+rowId+");";
            $('.modal-title').html('Edit product');
            editProduct(rowId);
        }
        $('#productSubmit').attr("onclick", productFunc);
    });

    $('#modalProductsAddEdit').on('hidden.bs.modal', function () {
        $('#productSubmit').attr("onclick", "");
        $(this).find('form')[0].reset();
        $(this).find('.statusMsg').html('');
    });
});