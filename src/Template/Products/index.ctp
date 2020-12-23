<?php
echo $this->Html->script([
    'https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js'
        ], ['block' => 'scriptLibraries']
);
$urlToRestApi = $this->Url->build([
    'prefix' => 'api',
    'controller' => 'Products'], true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Products/index', ['block' => 'scriptBottom']);
?>

<?php
use Cake\Utility\Security;
//echo Security::salt();
?>


<div  ng-app="app" ng-controller="ProductCRUDCtrl">
<table>
        <tr>
            <td width="200">User name (username):</td>
            <td><input type="text" id="username" ng-model="user.username" /></td>
        </tr>
        <tr>
            <td width="200">Mot de passe (password):</td>
            <td><input type="text" id="password" ng-model="user.password" /></td>
        </tr>
        <tr>
        <a ng-click="login(user)">[Connexion] </a>
        <a ng-click="logout()">[Déconnexion] </a>
        <a ng-click="changePassword(user.password)">[Changer le mot de passe]</a>              
        </tr>
    </table>
    <table>
        
            <td><input type="hidden" id="id" ng-model="product.id" /></td>
   
        <tr>
            <td width="100">Name :</td>
            <td><input type="text" id="name" ng-model="product.product_name" /></td>
        </tr>
        <tr>
            <td width="100">Details:</td>
            <td><input type="text" id="details" ng-model="product.product_description" /></td>
        </tr>
        <tr>
            <td width="100">Price:</td>
            <td><input type="number" id="datatype" ng-model="product.price" /></td>
        </tr>
        <tr>
            <td width="100">Other details:</td>
            <td><input type="text" id="datatype" ng-model="product.other_details" /></td>
        </tr>
    </table>
    <br /> <br /> 
    
    <button ng-click="updateProduct(product.id, product.product_name, product.product_description, product.price, product.other_details)">Update Product</button> 
    <button ng-click="addProduct(product.product_name, product.product_description, product.price, product.other_details)">Add Product</button>

    <br /> <br />
    <p style="color: green">{{message}}</p>
    <p style="color: red">{{errorMessage}}</p>

    <br />
    <br /> 
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
                    <tbody ng-Init="getAllProducts()">
                        
                                <tr ng-repeat="product in products | filter:search">
                                    <td class="text-align-center">
                                    {{product.id}}
                                    </td>
                                    <td>
                                    {{product.product_name}}
                                    </td>
                                    <td>
                                    {{product.product_description}} 
                                    </td>
                                    <td>
                                    {{product.price}}
                                    </td>
                                    <td>
                                    {{product.other_details}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" ng-click="getProduct(product.id)">Edit</button>
                                    </td>
                                    <td><button type="button" class="btn btn-warning btn-sm" ng-click="deleteProduct(product.id)">Delete</button></td>
                                </tr>
                    </tbody>
                </table>
                
 <!--   <pre ng-show='products'>{{products | json }}</pre>-->
</div>