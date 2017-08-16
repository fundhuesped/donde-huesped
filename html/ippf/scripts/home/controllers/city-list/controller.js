dondev2App.controller('cityListController',
  function(placesFactory, copyService, NgMap, $scope, $rootScope, $routeParams, $location, $http) {
    console.log('city List controller')
    $rootScope.navBar = $routeParams.servicio;
    $scope.checkbox = false;
    $scope.loading = true;
    $rootScope.main = false;
    $rootScope.geo = false;
    // $scope.events = "distance";

    $scope.province = $routeParams.provincia.split('-')[1];
    $scope.provinceId = $routeParams.provincia.split('-')[0];
    $scope.city = $routeParams.ciudad.split('-')[1];
    $scope.cityId = $routeParams.ciudad.split('-')[0];
    $scope.country = $routeParams.pais.split('-')[1];
    $scope.countryId = $routeParams.pais.split('-')[0];

    $scope.service = copyService.getFor($routeParams.servicio);

    $rootScope.navBar = $scope.service;
    var search = {
      provincia: $scope.provinceId,
      partido: $scope.cityId,
      pais: $scope.countryId,
      service: $routeParams.servicio.toLowerCase(),

    };
    search[$routeParams.servicio.toLowerCase()] = true;

    //aca tengo logica para ocultar
    placesFactory.getAllFor(search, function(data) {
      $rootScope.places = $scope.places = data;
      $scope.cantidad = $scope.places.length;

      if (typeof $rootScope.places[0] != 'undefined' && $rootScope.places[0].idPais != undefined) {
        //busco el tag para ILE por país
        var url = "api/v2/getiletag/" + $rootScope.places[0].idPais;
        $http.get(url)
          .then(function(response) {
            $scope.ileTag = "ile_" + response.data[0].nombre_pais;

          });
      }

      $scope.loading = false;
    })

    $scope.nextShowUp = function(item) {
      var urlCount = "api/v2/evaluacion/cantidad/" + item.placeId;
      $http.get(urlCount)
        .then(function(response) {
          item.votes = response.data[0];
        });

      // //aparte
      var urlRate = "api/v2/evaluacion/promedio/" + item.placeId;
      $http.get(urlRate)
        .then(function(response) {
          item.rate = response.data[0];
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



      var urlComments = "api/v2/evaluacion/comentarios/" + item.placeId;
      item.comments = [];
      $http.get(urlComments)
        .then(function(response) {
          item.comments = response.data;
          item.comments.forEach(function(comment) {
            comment.que_busca = comment.que_busca.split(',');
          });
          console.log("item.comments");
          console.log(item.comments);
        });


      $rootScope.places = $scope.cantidad = $scope.places;
      console.log(item)
      $rootScope.currentMarker = item;
      $rootScope.centerMarkers = [];
      //tengo que mostrar arriba en el map si es dekstop.
      $rootScope.centerMarkers.push($rootScope.currentMarker);

      $location.path('/' + $scope.country + '/' +
        $scope.province + '/' +
        $scope.city + '/' +
        $routeParams.servicio + '/mapa');

    };

    $scope.$watchCollection('checkbox', function(newValue, oldValue) {
      $scope.checkbox = newValue;
      if ($scope.checkbox) {
        var c = 0;
        for (var i = $scope.places.length - 1; i >= 0; i--) {
          if ($scope.places[i].es_rapido == 1) {
            c++;
          }
        }
        $scope.cantidad = c;
      } else {
        $scope.cantidad = $scope.places.length;
      }

    });

    $scope.onChange = function() {
      console.log($scope.cantidad);
    }

    $scope.esFriendly = function() {
      return function(item) {
        if ($scope.onlyFriendly == 1) {
          console.log("entra en onlyFriendly = 1");
          if (item.friendly_dc == 1 || item.friendly_ssr == 1 || item.friendly_ile == 1 || item.friendly_mac == 1 || item.friendly_prueba == 1 || item.friendly_condones == 1) {
            return item;
          }
        } else {
          console.log("entra en onlyFriendly = 0");
          return item;
        }
      }
    }

    $scope.tieneServicioFriendly = function(item) {
      if (item.friendly_dc == 1 || item.friendly_ssr == 1 || item.friendly_ile == 1 || item.friendly_mac == 1 || item.friendly_prueba == 1 || item.friendly_condones == 1) {
        console.log("tiene servicio friendly");
        return true;
      } else {
        console.log("NO tiene servicio friendly");
        return false;
      }
    }

    $scope.esRapido = function() {
      return function(item) {
        if ($scope.checkbox == true) {
          if (item.es_rapido == 1) {
            return item;
          }
        }
        if ($scope.checkbox == false) {
          return item;
        }
      }
    };



  });
