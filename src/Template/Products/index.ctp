<?php
$urlToRestApi = $this->Url->build('/api/products', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Products/index', ['block' => 'scriptBottom']);
$user = $this->Session->read('Auth.User');
if(empty($user)){
    $user['id']= 1;
}

$urlToProductAutocompletedemoJson = $this->Url->build([
    "controller" => "Products",
    "action" => "findProductNames",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToProductAutocompletedemoJson . '";', ['block' => true]);
echo $this->Html->script('Products/add-edit/productsAutoComplete', ['block' => 'scriptBottom']);

?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 head">
                    <h5>Products</h5>
                    <!-- Add link -->
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" data-type="add" data-toggle="modal" data-target="#modalProductsAddEdit"><i class="plus"></i> New Product</a>
                    </div>
                </div>
                <div class="statusMsg"></div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Price</th>
                            <th>Other details</th>
                        </tr>
                    </thead>
                    <tbody id="productData">
                        <?php if (!empty($products)) {
                            foreach ($products as $row) { ?>
                                <tr>
                                    <td><?php echo '#' . $row['id']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['product_description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['other_details']; ?></td>

                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-warning" 
                                           rowID="<?php echo $row['id']; ?>" data-type="edit" 
                                           data-toggle="modal" data-target="#modalProductsAddEdit">
                                            edit
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger" 
                                           onclick="return confirm('Are you sure to delete data?') ? 
                                               productAction('delete', '<?php echo $row['id']; ?>') : false;">
                                            delete
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr><td colspan="5">No product found...</td></tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Modal Add and Edit Form -->
        <div class="modal fade" id="modalProductsAddEdit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Product</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="statusMsg"></div>
                        <form role="form">
                            <div class="form-group">
                                <label for="product_name">Product name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter the product name">
                            </div>
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Enter the product description">
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                            <div class="form-group">
                                <label for="other_details">Other product details</label>
                                <input type="text" class="form-control" name="other_details" id="other_details" placeholder="Enter other details here">
                            </div>
                            <input type="hidden" class="form-control" name="id" id="id"/>
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="<? echo $user['id']?>"/>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="productSubmit">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
