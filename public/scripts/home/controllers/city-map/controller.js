dondev2App.controller('cityMapController',
  function(placesFactory, NgMap, copyService, $scope, $rootScope, $routeParams, $location, $http) {
    //controlador para busqueda escrita
    $rootScope.$watch('currentMarker', function() {
      $scope.currentMarker = $rootScope.currentMarker;
    })

    // Verificar que exista cargado un establecimiento
    checkCurrentMarker();
    function checkCurrentMarker(){
      if(!$rootScope.currentMarker || !$scope.currentMarker)
        window.history.back();
    }

    $rootScope.main = false;
    $rootScope.geo = false;

    if ($routeParams.ciudad) {
      $scope.ciudad = $routeParams.ciudad.split('-')[1];
      $scope.ciudadId = $routeParams.ciudad.split('-')[0];
    } else {
      $scope.ciudad = "";
    }

    $scope.city = $routeParams.partido.split('-')[1];
    $scope.cityId = $routeParams.partido.split('-')[0];

    $scope.province = $routeParams.provincia.split('-')[1];
    $scope.provinceId = $routeParams.provincia.split('-')[0];

    $scope.country = $routeParams.pais.split('-')[1];
    $scope.countryId = $routeParams.pais.split('-')[0];

    $scope.service = copyService.getFor($routeParams.servicio);
    $scope.serviceCode = $scope.service.code;

    $rootScope.navBar = $scope.service;

  //  $scope.currentService = JSON.parse($routeParams.servicio);

  var search = {

    ciudad: $scope.ciudadId,
    partido: $scope.cityId,
    provincia: $scope.provinceId,
    pais: $scope.countryId,
    service: $routeParams.servicio.toLowerCase(),

  };
  search[$routeParams.servicio.toLowerCase()] = true;

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
    comments.forEach(function(comment){
      if(comment.service == $routeParams.servicio){
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

  $scope.nextShowUp = function(item) {

    var urlCount = "api/v2/evaluacion/cantidad/" + item.placeId;
    $http.get(urlCount)
    .then(function(response) {
      item.votes = response.data;
    });

      // //aparte
      var urlRate = "api/v2/evaluacion/promedio/" + item.placeId;
      $http.get(urlRate)
      .then(function(response) {
        item.rate = response.data;
        item.faceList = [{
          id: '1',
          image: '1',
          imageDefault: '1',
          imageBacon: '1active'
        },
        {
          id: '2',
          image: '2',
          imageDefault: '2',
          imageBacon: '2active'
        },
        {
          id: '3',
          image: '3',
          imageDefault: '3',
          imageBacon: '3active'
        },
        {
          id: '4',
          image: '4',
          imageDefault: '4',
          imageBacon: '4active'
        },
        {
          id: '5',
          image: '5',
          imageDefault: '5',
          imageBacon: '5active'
        }
        ];


        var pos = -1;
        for (var i = 0; i < item.faceList.length; i++) {
          item.faceList[i].image = item.faceList[i].imageDefault;
          if (item.faceList[i].id == item.rate) pos = i;
        }
          //si tiene votos cambio el color
          if (pos != -1)
            item.faceList[pos].image = item.faceList[pos].imageBacon;
        });

      $rootScope.currentMarker = item;
      $rootScope.centerMarkers.push($rootScope.currentMarker);

      //con esto centro el mapa en el place correspondiente
      $location.path('/localizar' + '/' + $routeParams.servicio + '/mapa');

    }

    $scope.showCurrent = function(i, p) {

      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;

    }

    $scope.closeCurrent = function() {
      $scope.currentMarker = undefined;
    }

    if ($rootScope.places.length > 0 && $rootScope.currentMarker) {
      $rootScope.centerMarkers.push($rootScope.currentMarker);
    } else {
      placesFactory.getAllFor(search, function(data) {
        $rootScope.places = $scope.places = data;
        $rootScope.currentMarker = $scope.currentMarker = $scope.places[0];
        $rootScope.centerMarkers.push($rootScope.currentMarker);
      })
    }

    gtag('event','ver_centro', {
      'event_category': $rootScope.currentMarker.establecimiento,
      'event_label': $rootScope.currentMarker.nombre_pais + ' - ' + $rootScope.currentMarker.nombre_ciudad,
    });


  });
