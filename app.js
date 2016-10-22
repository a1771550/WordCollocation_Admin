'use strict';
var serviceBase = 'http://localhost:8080/web-service/web/'
// Declare app level module which depends on views, and components
var wcApp = angular.module('wcApp', [
    'ngRoute',
    'wcApp.site',
    'wcApp.book',
]);
var spaApp_site = angular.module('wcApp.site', ['ngRoute'])
var spaApp_book = angular.module('wcApp.book', ['ngRoute']);

wcApp.config(['$routeProvider', function($routeProvider) {
    $routeProvider.otherwise({redirectTo: '/site/index'});
}]);
