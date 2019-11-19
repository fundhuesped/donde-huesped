dondev2App.controller('cityMapController2',
  function(placesFactory, NgMap, copyService, $scope, $rootScope, $routeParams, $location, $http,$translate) {

    $rootScope.selectedLanguage = $routeParams.lang;
    $translate.use($routeParams.lang);

    var id = $routeParams.id;
    var urlShow = "api/v1/panel/places/" + id;

    $scope.voteLimit = 5;


    




    $http({
      method: "GET",
      url: urlShow
    }).then(function mySucces(response) {

      $rootScope.main = false;
      $rootScope.geo = false;
      $scope.province = response.data[0].nombre_provincia;
      $scope.provinceId = response.data[0].idProvincia;
      $scope.city = response.data[0].nombre_partido;
      $scope.cityId = response.data[0].idPartido;
      $scope.ciudadId = response.data[0].idCiudad;
      $rootScope.ciudad = response.data[0].nombre_ciudad;
      $scope.country = response.data[0].nombre_pais;
      $scope.countryId = response.data[0].idPais;


      $scope.showCurrent = function(i, p) {
        $scope.currentMarker = p;
      }

      $scope.closeCurrent = function() {
        $scope.currentMarker = undefined;
      }
      $rootScope.places = [response.data[0]];
      $rootScope.currentMarker = response.data[0];
      $scope.currentMarker = response.data[0];
      var item = $rootScope.currentMarker;
       var urlComments = "api/v2/evaluacion/comentarios/" + id;
      item.comments = [];
      $http.get(urlComments)
        .then(function(response) {
         item.comments = response.data;
          item.comments.forEach(function(comment) {
            comment.que_busca = comment.que_busca.split(',');
          });
        });
      $rootScope.moveMapTo = {
        latitude: parseFloat($rootScope.currentMarker.latitude),
        longitude: parseFloat($rootScope.currentMarker.longitude),
        zoom: 18,
        center: true,
      };
      $rootScope.centerMarkers = [];
      $rootScope.centerMarkers.push($rootScope.currentMarker);
      
      // //aparte
      var urlRate = "api/v2/evaluacion/promedio/" + id;
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

    console.log($rootScope.currentMarker.establecimiento);
    console.log($rootScope.currentMarker.placeId);
    console.log($rootScope.currentMarker.nombre_pais);
    console.log($rootScope.currentMarker.nombre_ciudad);
      gtag('event','ver_centro', {
          'event_category': $rootScope.currentMarker.establecimiento,
          'event_label': $rootScope.currentMarker.nombre_pais + ' - ' + $rootScope.currentMarker.nombre_ciudad,
      });
    

    }); //del get


  });
