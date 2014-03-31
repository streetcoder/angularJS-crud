
//This handles retrieving data and is used by controllers. 3 options (server, factory, provider) with
//each doing the same thing just structuring the functions/data differently.
app.service('productsService', function ($http) {

    this.getProducts = function () {
        return $http.get("app/server/db.php?action=read");
    };

    this.insertProduct = function (name, code, description, price) {

        return $http.post("app/server/db.php?action=insert",
            {
                'name': name,
                'code': code,
                'description': description,
                'price': price
            });
    };

    this.deleteProduct = function (id) {
        return $http.post("app/server/db.php?action=delete",{'id': id});
    };

});
