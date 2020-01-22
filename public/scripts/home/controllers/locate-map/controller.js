dondev2App.controller('locateMapController',
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
    $rootScope.serviceCode =  $routeParams.servicio.toLowerCase();

    $rootScope.geo = true;
    $scope.service = $routeParams.servicio;
    $rootScope.navBar =$scope.service ;
    $rootScope.places = [];
    $scope.main = true;
    $rootScope.main = false;
    var onLocationError = function(e){
      $scope.$apply(function(){
        $location.path('/call/help');
      });
    };

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
      parametros = $routeParams.servicio.split('"');
      servicio = parametros[15];
      comments.forEach(function(comment){
        if(comment.service == servicio){
          c.unshift(comment);
          n++;
        }
        else
          c = c.concat([comment]);
      });

      $rootScope.voteLimit = n;

      return c;
    };

    $scope.loadComments();

    $scope.serviceCode =  $routeParams.servicio.toLowerCase();
    var onLocationFound = function(position){
      $scope.$apply(function(){
       placesFactory.forLocation(position.coords, function(result){
              //$rootScope.places = $scope.places = $scope.closer = result;
							//tener en cuenta esta linea comentada
              $scope.currentPos = position.coords;
              $rootScope.moveMapTo = {
                latitude:position.coords.latitude,
                longitude:position.coords.longitude,
              };
            });
     });
    };

    $scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
      $rootScope.centerMarkers = [];
      //tengo que mostrar arriba en el map si es dekstop.
      $rootScope.centerMarkers.push($rootScope.currentMarker);

    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
  });
