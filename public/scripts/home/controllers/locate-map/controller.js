dondev2App.controller('locateMapController',
	function(placesFactory, copyService, NgMap, $scope,$rootScope, $routeParams, $location, $http){
    $rootScope.geo = true;
    $scope.service = copyService.getFor($routeParams.servicio);
    $rootScope.serviceCode = $scope.service.code;
    $rootScope.navBar = $scope.service ;
    $scope.main = true;
    $rootScope.main = false;

    // Verificar que exista cargado un establecimiento
    checkCurrentMarker();
    function checkCurrentMarker(){
      if(!$rootScope.currentMarker || !$scope.currentMarker)
        window.history.back();
    }

    $scope.showNextComments = function() {
      var item = $rootScope.currentMarker;
      if(!item || !item.comments || !item.comments.length) return;
      $scope.voteLimit = item.comments.length;
    }

    $scope.loadComments = function(){  
      var item = $rootScope.currentMarker;
      var urlComments = "api/v2/evaluacion/comentarios/" + item.placeId;
      item.comments = [];
      $http.get(urlComments)
      .then(function(response) {
        item.comments = response.data;
        item.comments = filtrarPorServicio(item.comments);
        item.comments.forEach(function(comment) {
          comment.que_busca = comment.que_busca.split(',');
        });
        $rootScope.currentMarker = item;
      });
    }

    function filtrarPorServicio(comments){
      c = [];
      n = 0;
      servicio = $rootScope.serviceCode;
      comments.forEach(function(comment){
        if(comment.service == servicio){
          c.unshift(comment);
          n++;
        }
        else
          c = c.concat([comment]);
      });

      $scope.voteLimit = n;

      return c;
    };

    $scope.loadComments();

  });
