dondev2App.controller('formController', function(NgMap,vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location) {
  $rootScope.main = true;
  $scope.invalid = true;
  $scope.place = {};
  $scope.spinerflag=false;

  $scope.onDragEnd = function(e) {
                    console.log("drag ended",e);
                    $scope.place.latitude = e.latLng.lat();
                    $scope.place.longitude = e.latLng.lng()
  };
$scope.isChecked = function(d){
    if (d === 1 || d === true){
      return true;
    }
    else {
      return false;
    }
  }

  var onLocationFound = function(position){
    
      $scope.$apply(function(){
         $scope.waitingLocation= false;
        $scope.position = position;
        console.log(position);
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        $scope.place.latitude = lat;
        $scope.place.longitude = lon;


        $scope.place.position = [lat, lon];

            

              $scope.positions = [];
              $scope.positions.push($scope.place);
              $scope.center = [lat, lon];


              $scope.loading = false;
              console.log($scope.center);
              console.log($scope.place.position);
              var map = NgMap.initMap('mapEditor');
              map.panTo(new google.maps.LatLng(lat,lon));

      });

  }
  var onLocationError = function(){
         Materialize.toast('Lo sentimos no hemos podido ubicar tu localización.', 5000);           
  }
  $scope.lookupLocation = function(){

    if (navigator.geolocation){
    $scope.waitingLocation= true;
        navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
      }else {
        ga('send', 'event', 'geolalizacion', 'localizacioNoFunciona',"");
        alert("no location found");
        
      }


  };
  function invalidForm() {

    var flag = (
      //(vcRecaptchaService.getResponse() === "") ||
      (!$scope.aceptaTerminos) ||
      (typeof $scope.place.idPais === "undefined") ||
      (typeof $scope.place.idProvincia === "undefined") ||
      (typeof $scope.place.idPartido === "undefined") ||
      (!$scope.place.establecimiento || 0 === $scope.place.establecimiento.length));
    
    return flag;
  }


  function invalidCity() {
    return false;//((typeof $scope.myCity === "undefined") && (!$scope.otra_localidad || 0 === $scope.otra_localidad.length));

  }


  $scope.formChange = function() {
    if (invalidForm() || invalidCity()) {
      $scope.invalid = true;
    } else {
      $scope.invalid = false;
    }
  };

  function processServices(){
      if ($scope.place.vacunatorio){
          $scope.place.responsable_vac = $scope.place.responsable || '';
          $scope.place.horario_vac = $scope.place.horario|| '';
          $scope.place.mail_vac = $scope.place.mail|| '';
          $scope.place.tel_vac = $scope.place.telefono|| '';
          $scope.place.web_vac = $scope.place.web || '';
      }
      else {
        $scope.place.vacunatorio = false;
      }

      if ($scope.place.prueba){
          $scope.place.responsable_testeo  = $scope.place.responsable || '';
          $scope.place.horario_testeo = $scope.place.horario || '';
          $scope.place.mail_testeo = $scope.place.mail || '';
          $scope.place.tel_testeo= $scope.place.telefono || '';
          $scope.place.web_testeo = $scope.place.web || '';
      }
      else {
        $scope.place.prueba = false;
      }


      if ($scope.place.condones){
          $scope.place.responsable_distrib = $scope.place.responsable || '';   
          $scope.place.horario_distrib  = $scope.place.horario || '';
          $scope.place.mail_distrib = $scope.place.mail || '';
          $scope.place.tel_distrib  = $scope.place.telefono || '';
          $scope.place.web_distrib  = $scope.place.web || '';
      }
      else {
        $scope.place.condones = false;
      }


      if ($scope.place.infectologia){
          $scope.place.responsable_infectologia = $scope.place.responsable || '';
          $scope.place.horario_infectologia = $scope.place.horario || '';
          $scope.place.mail_infectologia = $scope.place.mail || '';
          $scope.place.tel_infectologia = $scope.place.telefono|| '';
          $scope.place.web_infectologia = $scope.place.web || '';
      }
      else {
        $scope.place.vacunatorio = false;
      }
        
        
      
    

  }

  $scope.clicky = function() {

      $scope.invalid = true;
      $scope.spinerflag= true;

      processServices();
      var data = $scope.place;     
      

      
      // if (typeof $scope.otra_localidad !== "undefined") {

      //     data["nombre_localidad"] = $rootScope.otra_localidad;

      // }

        $http.post('api/v1/places', data)
        .then(
          function(response) {
            $scope.spinerflag= false;
            if (response.data.length === 0) {
              Materialize.toast('Su peticion a sido enviada!', 5000);
              $("button").remove();
               $("input").val("");
               document.location.href = $location.path();
            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
              }
              $scope.spinerflag = false;
              $scope.formChange();
            }

          },
          function(response) {
            Materialize.toast('Intenta nuevamente mas tarde.', 5000);
            $scope.invalid = false;
            $scope.spinerflag = false;

          });



    // if ($scope.place.latitude)

    // var geocoder = new google.maps.Geocoder();

    // var address = data.direccion + ", " + data.nombre_localidad + ", " + data.nombre_provincia;

    // console.log(address);
    // geocoder.geocode({
    //   'address': address
    // }, function(results, status) {

      // console.log("Results: " + results);
      // console.log("Status: " + status);
      // if (status == google.maps.GeocoderStatus.OK) {

        // data.latitude = results[0].geometry.location.lat();
        // data.longitude = results[0].geometry.location.lng();
        // data.formattedAddress = results[0].formatted_address;

        // console.log(data.latitude);
        // console.log(data.longitude);
        // console.log(data.formattedAddress);
    // } else {

        // alert("Geocode was not successful for the following reason: " + status);
        // $scope.invalid = false;
        // $scope.spinerflag = false;

      // }
    // });

  };

  placesFactory.getCountries(function(countries){
    $scope.countries = countries;
  })
  




  $scope.loadCity = function(){
    $scope.showCity = true;
    placesFactory.getCitiesForProvince({id:$scope.place.idProvincia},function(data){
      $scope.cities = data;
    })

  };


  $scope.showProvince = function(){
    
    $scope.provinceOn= true;
    placesFactory.getProvincesForCountry($scope.place.idPais,function(data){
      $scope.provinces = data;
    });
    
  }
});
