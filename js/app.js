var app = angular.module('app', ['ngRoute', 'ngSanitize']);

//Config the route
app.config(['$routeProvider', '$locationProvider', '$httpProvider', function($routeProvider, $locationProvider, $httpProvider) {
    // $locationProvider.html5Mode(true);

    $routeProvider
        .when('/', {
            templateUrl: altruismLocalized.partials + 'main.html',
            controller: 'Main'
        })
        .when('/post/:ID', {
            templateUrl: altruismLocalized.partials + 'single.html',
            controller: 'Post'
        })
        .when('/page/:ID', {
            templateUrl: altruismLocalized.partials + 'page.html',
            controller: 'Page'
        })
        .when('/category/:ID/', {
            templateUrl: altruismLocalized.partials + 'category.html',
            controller: 'Category'
        })
        .otherwise({
            templateUrl: altruismLocalized.partials + '404.html',
            controller: '404'
        });
}]);

//Main controller
app.controller('Main', ['$scope','$http', function($scope,$http) {

    $http.get( altruismLocalized.root + 'wp/v2/posts').
      success(function(data, status, headers, config) {
        $scope.posts = data;
      }).
      error(function(data, status, headers, config) {
      });

}]);

//Post controller
app.controller('Post', ['$scope','$routeParams', '$http', function($scope, $routeParams, $http) {

    $http.get( altruismLocalized.root + 'wp/v2/posts/'+ $routeParams.ID).
      success(function(data, status, headers, config) {
        $scope.post = data;
        $http.get( altruismLocalized.root + 'wp/v2/categories/?include='+ $scope.post.categories).
          success(function(data, status, headers, config) {
            $scope.post.categories = data;
          });

      });

}]);

// Page controller
app.controller('Page', ['$scope','$routeParams', '$http', function($scope, $routeParams, $http) {

    $http.get( altruismLocalized.root + 'wp/v2/pages/'+ $routeParams.ID).
      success(function(data, status, headers, config) {

        $scope.post = data;

      });

}]);

// Category controller
app.controller('Category', ['$scope','$routeParams', '$http', function($scope, $routeParams, $http) {

    $http.get( altruismLocalized.root + 'wp/v2/categories/'+ $routeParams.ID).
      success(function(data, status, headers, config) {
        $scope.category = data;
        $http.get( altruismLocalized.root + 'wp/v2/posts/?filter[cat]='+ $scope.category.id).
          success(function(data, status, headers, config) {
            $scope.category.posts = data;
          });

      });

}]);
