dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.controller('panelplaceController', function($timeout,placesFactory,NgMap, $scope, $rootScope, $http, $location, $route, $routeParams) {

  $scope.spinerflag= false;

  angular.element(document).ready(function() {

      $scope.loading = true;
     $scope.onDragEnd = function(e) {
                    console.log("drag ended",e);
                    $rootScope.place.latitude = e.latLng.lat();
                    $rootScope.place.longitude = e.latLng.lng()
    };




    $http.get('../../api/v1/panel/places/' + $scope.placeId).success(function(response) {
        $rootScope.place = response[0];
        console.log(response[0]);

       


        if (typeof response[0] !== "undefined" && response[0] != 0) {
            if (typeof response[0].latitude !== "undefined" && response[0].latitude != 0) {
              var lat = response[0].latitude;
              var lon = response[0].longitude;

              var imageSize = Math.round($(window).width() / 2);

              var imageHeight = Math.round($(window).height() * 0.75);
              if ($(window).height() < 800) {
                imageHeight = Math.round($(window).height() / 3);
              }

              var formatedSize = imageSize + "x" + imageHeight;
              var googleMaps = "https://maps.googleapis.com/maps/api/staticmap?center=" + lat + "," + lon + "&zoom=14&size=" + formatedSize;
              googleMaps += "&markers=color:blue%7Clabel:C%7C" + lat + "," + lon;
              var streetView = "https://maps.googleapis.com/maps/api/streetview?size=" + formatedSize + "&location=" + lat + "," + lon + "&heading=100"
              $scope.googleMaps = googleMaps;
              $scope.streetView = streetView;
              $rootScope.place.position = [lat, lon];

            

              $scope.positions = [];
              $scope.positions.push($rootScope.place);
              $scope.center = [lat, lon];


              $scope.loading = false;
              console.log($scope.center);
              console.log($rootScope.place.position);

              NgMap.initMap('mapEditor');


            }
        }
    });
});

  function invalidForm() {

      return false;
  }


  $scope.formChange = function() {

      if (invalidForm()) {
          $scope.invalid = true;
      } else {
          $scope.invalid = false;
      }
  };

  $scope.clickyDis = function() {

    if (confirm("Desea realmente rechazar la peticion de la lugar " + $rootScope.place.establecimiento + "?")) {

            $scope.spinerflag= true;

    $http.post('../../api/v1/panel/places/' + $rootScope.place.placeId + '/block')
        .then(
          function(response) {
            if (response.data.length == 0) {
                 Materialize.toast('Hemos rechazado a   ' + $rootScope.place.establecimiento , 5000);
                 document.location.href = $location.path() + '../../panel';

            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
              };
            }

                  $scope.spinerflag= false;

          },
          function(response) {
            Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
            $scope.spinerflag= false;
          });
    }
  };
  $scope.clickyApr = function() {

    if (confirm("Desea realmente aprobar la peticion de la lugar " + $rootScope.place.establecimiento + "?")) {

            $scope.spinerflag= true;

    $http.post('../../api/v1/panel/places/' + $rootScope.place.placeId + '/approve')
        .then(
          function(response) {
            if (response.data.length == 0) {
                 Materialize.toast('Hemos aprobado a   ' + $rootScope.place.establecimiento, 5000);
                 document.location.href = $location.path() + '../../panel';

            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
              };
            }

                  $scope.spinerflag= false;

          },
          function(response) {
            Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
            $scope.spinerflag= false;
          });
    }
  };



  $scope.clicky = function() {

      $scope.spinerflag= true;

      var httpdata = $rootScope.place;     
      

      
      if (typeof $scope.otra_localidad !== "undefined") {

          data["nombre_localidad"] = $rootScope.otra_localidad;

      }

        $http.post('../../api/v1/panel/places/' + $rootScope.place.placeId + '/update', httpdata)
        .then(
          function(response) {
            if (response.data.length == 0) {

               Materialize.toast('Hemos guardado los datos de  ' + $rootScope.place.establecimiento , 5000);
                 document.location.href = $location.path() + '../../panel';


           
            } else {
                for (var propertyName in response.data) {
                    Materialize.toast(response.data[propertyName], 10000);
                };
            }
            $scope.spinerflag= false;
        },
          function(response){
          Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
          $scope.spinerflag= false;
        });

  };

});
