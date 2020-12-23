var app = angular.module('app', []);
var urlToRestApiUsers = urlToRestApi.substring(0, urlToRestApi.lastIndexOf('/') + 1) + 'users';

app.controller('ProductCRUDCtrl', ['$scope', 'ProductCRUDService', function ($scope, ProductCRUDService) {

        $scope.updateProduct = function () {
            ProductCRUDService.updateProduct(product)
                    .then(function success(response) {
                        $scope.message = 'Product data updated!';
                        $scope.errorMessage = '';
                        $scope.getAllProducts();
                    },
                            function error(response) {
                                $scope.errorMessage = 'Error updating product!';
                                $scope.message = '';
                            });
        }

        $scope.getProduct = function (id) {
            ProductCRUDService.getProduct(id)
                    .then(function success(response) {
                        $scope.product = response.data.product;
                        $scope.product.id = id;
                        $scope.message = '';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.message = '';
                                if (response.status === 404) {
                                    $scope.errorMessage = 'Product not found!';
                                } else {
                                    $scope.errorMessage = "Error getting product!";
                                }
                            });
        }

        $scope.addProduct = function () {
            if ($scope.product != null && $scope.product.product_name) {
                ProductCRUDService.addProduct($scope.product.product_name, $scope.product.product_description, $scope.product.price, $scope.product.other_details)
                        .then(function success(response) {
                            $scope.message = 'Product added!';
                            $scope.errorMessage = '';
                            $scope.getAllProducts();
                        },
                                function error(response) {
                                    $scope.errorMessage = 'Error adding product!';
                                    $scope.message = '';
                                });
            } else {
                $scope.errorMessage = 'Please enter a name!';
                $scope.message = '';
            }
        }

        $scope.deleteProduct = function (id) {
            ProductCRUDService.deleteProduct(id)
                    .then(function success(response) {
                        $scope.message = 'Product deleted!';
                        $scope.product = null;
                        $scope.errorMessage = '';
                        $scope.getAllProducts();
                    },
                            function error(response) {
                                $scope.errorMessage = 'Error deleting product!';
                                $scope.message = '';
                            })
        }

        $scope.getAllProducts = function () {
            ProductCRUDService.getAllProducts()
                    .then(function success(response) {
                        $scope.products = response.data.products;
                        $scope.message = '';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.message = '';
                                $scope.errorMessage = 'Error getting products!';
                            });
        }
        $scope.login = function () {
            if ($scope.user != null && $scope.user.username) {
                ProductCRUDService.login($scope.user)
                        .then(function success(response) {
                            $scope.message = $scope.user.username + ' en session!';
                            $scope.errorMessage = '';
                            localStorage.setItem('token', response.data.data.token);
                            localStorage.setItem('user_id', response.data.data.id);
                        },
                                function error(response) {
                                    $scope.errorMessage = 'Nom d\'utilisateur ou mot de passe invalide...';
                                    $scope.message = '';
                                });
            } else {
                $scope.errorMessage = 'Entrez un nom d\'utilisateur s.v.p.';
                $scope.message = '';
            }

        }
        $scope.logout = function () {
            localStorage.setItem('token', "no token");
            localStorage.setItem('user', "no user");
            $scope.message = '';
            $scope.errorMessage = 'Utilisateur déconnecté!';
        }
        $scope.changePassword = function () {
            ProductCRUDService.changePassword($scope.user.password)
                    .then(function success(response) {
                        $scope.message = 'Mot de passe mis à jour!';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.errorMessage = 'Mot de passe inchangé!';
                                $scope.message = '';
                            });
        }
    }]);

app.service('ProductCRUDService', ['$http', function ($http) {

        this.getProduct = function getProduct(productId) {
            return $http({
                method: 'GET',
                url: urlToRestApi + '/' + productId,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            });
        }

        this.addProduct = function addProduct(product_name, product_description, price, other_details) {
            return $http({
                method: 'POST',
                url: urlToRestApi,
                data: {product_name: product_name, product_description: product_description, price: price, other_details: other_details ,user_id: 1},
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            });
        }

        this.deleteProduct = function deleteProduct(id) {
            return $http({
                method: 'DELETE',
                url: urlToRestApi + '/' + id,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            })
        }

        this.updateProduct = function updateProduct(id, product_name, product_description,price,other_details) {
            return $http({
                method: 'PATCH',
                url: urlToRestApi + '/' + id,
                data: {product_name: product_name, product_description: product_description, price: price, other_details:other_details, user_id: 1},
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            })
        }

        this.getAllProducts = function getAllProducts() {
            return $http({
                method: 'GET',
                url: urlToRestApi,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            });
        }
        this.login = function login(user) {
            return $http({
                method: 'POST',
                url: urlToRestApiUsers + '/token',
                data: {username: user.username, password: user.password},
                headers: {'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'}
            });
        }
        this.changePassword = function changePassword(password) {
            return $http({
                method: 'PATCH',
                url: urlToRestApiUsers + '/' + localStorage.getItem("user_id"),
                data: {password: password},
                headers: {'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")
                }
            })
        }
    }]);
