myApp.controller('formController', function(vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location) {
  $rootScope.main = true;
  $scope.invalid = true;
  $scope.place = [];
  $scope.spinerflag=false;

  function invalidForm() {

    var flag = (
      (vcRecaptchaService.getResponse() === "") ||
      (!$scope.aceptaTerminos) ||
      (typeof $scope.myCountry === "undefined") ||
      (typeof $scope.myProvince === "undefined") ||
      (!$scope.razon_social || 0 === $scope.razon_social.length));
    
    return flag;
  }


  function invalidCity() {
    return ((typeof $scope.myCity === "undefined") && (!$scope.otra_localidad || 0 === $scope.otra_localidad.length));

  }


  $scope.formChange = function() {
    if (invalidForm() || invalidCity()) {
      $scope.invalid = true;
    } else {
      $scope.invalid = false;
    }
  };

  $scope.loadProvinces = function() {
    delete $scope.provinces;
    ga('send', 'event', 'sumalugar', 'cambiaPais',  $scope.myCountry.nombre_pais);
    $http.get('api-provincia/pais/' + $scope.myCountry.id).success(function(response) {
      $scope.provinces = response;
      $scope.formChange();
    });

    $scope.formChange();
  };

  $scope.loadCities = function() {
    delete $scope.cities;
    if ($scope.myProvince.nombre_provincia){
      ga('send', 'event', 'sumalugar', 'cambiaProvincia',  $scope.myProvince.nombre_provincia);
    }
    $http.get('api-localidad/provincia/' + $scope.myProvince.id).success(function(response) {
      $scope.cities = response;
      $scope.formChange();
    });

    $scope.formChange();
  };

  $scope.clicky = function() {

    var data;
    $scope.invalid = true;
    $scope.spinerflag = true;

    var abierta_24 = !((typeof $scope.disable24 === "undefined") && (!$scope.disable24));
    var movil = !((typeof $scope.disablemovil === "undefined") && (!$scope.disablemovil));

    if ((typeof $scope.myCity === "undefined")||($scope.myCity == null)) {

            data = {
              nombre: $scope.nombre,
              razon_social: $scope.razon_social,
              direccion: $scope.direccion,
              direccion_particular: $scope.direccion_particular,
              nombre_pais: $scope.myCountry.nombre_pais,
              nombre_provincia: $scope.myProvince.nombre_provincia,
              nombre_localidad: $scope.otra_localidad,
              piso: $scope.piso,
              nro_local: $scope.nro_local,
              cp: $scope.cp,
              mail: $scope.mail,
              tel: $scope.tel,
              tel_24: $scope.tel_24,
              cel: $scope.cel,
              abierta_24: abierta_24,
              web_url: $scope.web_url,
              entre_calle: $scope.entre_calle,
              idNextTel: $scope.idNextTel,
              movil: movil
            };

    } else {


      ga('send', 'event', 'sumalugar', 'ciudadNueva',  $scope.myCity);

      data = {
        nombre: $scope.nombre,
        razon_social: $scope.razon_social,
        direccion: $scope.direccion,
        direccion_particular: $scope.direccion_particular,
        nombre_pais: $scope.myCountry.nombre_pais,
        nombre_provincia: $scope.myProvince.nombre_provincia,
        nombre_localidad: $scope.myCity.nombre_localidad,
        piso: $scope.piso,
        nro_local: $scope.nro_local,
        cp: $scope.cp,
        mail: $scope.mail,
        tel: $scope.tel,
        tel_24: $scope.tel_24,
        cel: $scope.cel,
        abierta_24: abierta_24,
        web_url: $scope.web_url,
        entre_calle: $scope.entre_calle,
        idNextTel: $scope.idNextTel,
        movil: movil
      };

    }

    var geocoder = new google.maps.Geocoder();

    var address = data.direccion + ", " + data.nombre_localidad + ", " + data.nombre_provincia;

    console.log(address);
    geocoder.geocode({
      'address': address
    }, function(results, status) {

      console.log("Results: " + results);
      console.log("Status: " + status);
      if (status == google.maps.GeocoderStatus.OK) {

        data.latitude = results[0].geometry.location.lat();
        data.longitude = results[0].geometry.location.lng();
        data.formattedAddress = results[0].formatted_address;

        console.log(data.latitude);
        console.log(data.longitude);
        console.log(data.formattedAddress);

        $http.post('api', data).then(

          function(response) {

            if (response.data.length === 0) {
              Materialize.toast('Su peticion a sido enviada!', 5000);
              ga('send', 'event', 'sumalugar', 'nuevaAltaSatisfactoria',"");
              $("button").remove();
               $("input").val("");
               document.location.href = $location.path() + 'confirmation';
            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
                ga('send', 'event', 'sumalugar', 'errorEnAlta',response.data[propertyName]);
              }
              $scope.spinerflag = false;
              $scope.formChange();
            }

          },
          function(response) {
            ga('send', 'event', 'sumalugar', 'errorInterno',response.data);
            Materialize.toast('Intenta nuevamente mas tarde.', 5000);
            $scope.invalid = false;
            $scope.spinerflag = false;

          });

      } else {

        alert("Geocode was not successful for the following reason: " + status);
        $scope.invalid = false;
        $scope.spinerflag = false;

      }
    });

  };

  placesFactory.loadCountries(function() {
    $scope.countries = placesFactory.countries;
  });
});
