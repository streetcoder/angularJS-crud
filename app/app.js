
//This configures the routes and associates each route with a view and a controller
var app = angular.module('productsApp', ['ngRoute']);

//This configures the routes and associates each route with a view and a controller
app.config(function ($routeProvider) {
    $routeProvider
        .when('/products',
        {
            controller: 'ProductsController',
            templateUrl: 'app/partials/products.html'
        })
        .otherwise({ redirectTo: '/products' });
});

