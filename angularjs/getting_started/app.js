// create module
var firstApp = angular.module("firstApp",[]);

// create controller
firstApp.controller("mainController", function($scope){

  // create model object
  $scope.movies = [{title: "Godzilla"},{title: "Batman vs Superman"},{title: "Star Wars Episode VII"}];

});