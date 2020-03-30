dondev2App.controller('formController', function(NgMap, vcRecaptchaService, placesFactory, $scope, $rootScope, $http, $interpolate, $location, $translate) {

  $rootScope.main = true;
  $scope.invalid = true;
  $scope.invalidReason = true;
  $scope.place = {};
  $scope.spinerflag = false;

  $scope.placeDetails = {};
  $scope.placeID;
  $scope.cityAdressComponents = [ "locality", "sublocality" ];
  $scope.placesPredictions = [];

  $scope.onDragEnd = function(e) {

    $scope.place.latitude = e.latLng.lat();
    $scope.place.longitude = e.latLng.lng()
  };
  $scope.isChecked = function(d) {
    if (d === 1 || d === true) {
      return true;
    } else {
      return false;
    }
  }

  try {

    if (typeof localStorage.lang !== "undefined") {

      $http.get('changelang/' + localStorage.lang)
        .success(
          function(response) {

            $translate.use(localStorage.getItem("lang"));
          },
          function(response) {
            Materialize.toast('Intenta nuevamente mas tarde.', 5000);
          });
    } else {
      var userLang = navigator.language || navigator.userLanguage; // es-AR
      var userLang = userLang.split('-')[0]; // es
      localStorage.setItem("lang", userLang);
      $translate.use(userLang);
    }

  } catch (err) {
    if (typeof(err) !== "undefined") {
      localStorage.setItem("lang", "es");
    }
  }


  var onLocationFound = function(position) {

    $scope.$apply(function() {
      $scope.waitingLocation = false;
      $scope.position = position;
      var lat = position.coords.latitude;
      var lon = position.coords.longitude;
      $scope.place.latitude = lat;
      $scope.place.longitude = lon;


      $scope.place.position = [lat, lon];

      $scope.positions = [];
      $scope.positions.push($scope.place);
      $scope.center = [lat, lon];

      $scope.loading = false;
      var map = NgMap.initMap('mapEditor');
      map.panTo(new google.maps.LatLng(lat, lon));

    });

  }

  var onLocationError = function() {
    Materialize.toast('Lo sentimos no hemos podido ubicar tu localización.', 5000);
  }

  $scope.lookupLocation = function() {
    if (navigator.geolocation) {
      $scope.waitingLocation = true;
      navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
    } else {
      ga('send', 'event', 'geolalizacion', 'localizacioNoFunciona', "");
      alert("no location found");

    }
  };

  $scope.invalidForm = function(){
    $scope.invalid = true;

    if(!$scope.place.establecimiento){$scope.invalidReason = "Debes ingresar un nombre para el establecimiento";}
    else if($scope.place.establecimiento.length < 3){$scope.invalidReason = "El nombre del establecimientos debe ser más largo";}
    else if($scope.place.tipo === undefined){$scope.invalidReason = "Debes seleccionar un tipo de establecimiento";}
    else if(!$scope.place.nombreCiudad){$scope.invalidReason = "Debes ingresar una ciudad";}
    else if(!$scope.place.calle){$scope.invalidReason = "Debes ingresar una calle";}
    else if(!$scope.place.altura){$scope.invalidReason = "Debes ingresar un número para la calle ingresada";}
    else if(!($scope.place.condones) && !($scope.place.prueba) && !($scope.place.vacunatorio) &&
            !($scope.place.infectologia) && !($scope.place.ssr) && !($scope.place.ile) ){
      $scope.invalidReason = "Debes seleccionar al menos un servicio";}
    else if(!$scope.place.uploader_name){$scope.invalidReason = "Debes ingresar tu nombre para que podamos contactarte";}
    else if(!$scope.place.uploader_email && !$scope.place.uploader_tel){
      $scope.invalidReason = "Debes ingresar un email/telefono para que podamos contactarte";}
    else if(!$scope.aceptaTerminos){$scope.invalidReason = "Debes aceptar los términos y condiones para continuar";}
    else{
      $scope.invalid = false;
    }
  }

  function invalidCity() {
    return false; //((typeof $scope.myCity === "undefined") && (!$scope.otra_localidad || 0 === $scope.otra_localidad.length));
  }

  //Returns the address component of the current place, with the type given
  $scope.addressComponentsByType = function( type ){
      var placeData = $scope.placeDetails;
      if( placeData && placeData.address_components ){
          var addressComponent = placeData.address_components.find(function(element) {

              return (element.types.indexOf(type) != -1);
          });
          if ( addressComponent )
              return addressComponent.long_name;
      }
      return "";
  }

  $scope.updatePlacePredictions = function( searchQuery ){

        if ( !searchQuery )
            searchQuery = " ";

        var cb = function(r, status,c){
            $scope.placesPredictions = r.data.localidades;
            $scope.formChange();

        };

        $http.get('https://apis.datos.gob.ar/georef/api/localidades?nombre='+ searchQuery).then(cb);
  
       
  }

  

  //Sets the place ID, updates the place google details, and updates the place useful informacion
  $scope.updateAddressComponents = function( autocompleteData ){
      if ( autocompleteData )
        $scope.placeID = autocompleteData.originalObject.id;
      else
        $scope.placeID = -1;
      $scope.currentPlace = autocompleteData.originalObject;
      console.log(autocompleteData.originalObject);

          $scope.locationChange();
          $scope.formChange();
      

  }
  $scope.currentPlace = {};
  $scope.locationOut = function(){
    //if (!$scope.place.googlePlaceID)

    if (!$scope.currentPlace.id){
      $scope.searchStr = "";
      if($('#ciudad_value').val() != ''){
        $('#ciudad_value').toggleClass('valid');
      }
      setTimeout(function(){ 
     	  $('#ciudad_value').val('') },200);
      $scope.formChange();
    }
    
  }

  //Sets the place location information
  $scope.locationChange = function() {
      //Pais
        $scope.place.nombrePais = "Argentina";
        //Provincia
        $scope.place.nombreProvincia = $scope.currentPlace.provincia.nombre;
        //Ciudad
        $scope.place.nombreCiudad = $scope.currentPlace.nombre.toLowerCase().toProperCase();
        $scope.place.barrio_localidad = $scope.place.nombreCiudad;
        //Partido
        $scope.place.nombrePartido =$scope.currentPlace.departamento.nombre;
        $scope.place.googlePlaceID = $scope.currentPlace.id;
  }

  $scope.verifyServices = function(){
    if($('#filled-in-box-pruebaRapida').is(":checked")){
      $scope.place.prueba = true;
      $('#filled-in-box-prueba').prop("checked",true);
    }
    if($('#filled-in-box-diu').is(":checked")){
      $scope.place.ssr = true;
      $('#filled-in-box-ssr').prop("checked",true);
    }
  }

  $scope.formChange = function() {
    $scope.verifyServices();
    //console.log($scope.place);

    //if (invalidForm() || invalidCity()) {
    
    if (!$scope.place.uploader_email && !$scope.place.uploader_tel) {
       $('#email').css("border-bottom", "red solid 1px");
       $('#email').css("box-shadow", "0 1px 0 0 red");
       $('#uploader-tel').css("border-bottom", "red solid 1px");
       $('#uploader-tel').css("box-shadow", "0 1px 0 0 red");
    }else{
       $('#uploader-tel').css("border-bottom", "#4CAF50 solid 1px");
       $('#uploader-tel').css("box-shadow", "0 1px 0 0 #4CAF50");
       $('#email').css("border-bottom", "#4CAF50 solid 1px");
       $('#email').css("box-shadow", "0 1px 0 0 #4CAF50");
    }
    
    if($scope.place.altura) {
       $('#altura').css("border-bottom", "#4CAF50 solid 1px");
       $('#altura').css("box-shadow", "0 1px 0 0 #4CAF50");
    }else{
       $('#altura').css("border-bottom", "red solid 1px");
       $('#altura').css("box-shadow", "0 1px 0 0 red");
    }

    $scope.invalidForm();
  };

  function processServices() {
    if ($scope.place.condones) {
      $scope.place.responsable_distrib = $scope.place.responsable || '';
      $scope.place.horario_distrib = $scope.place.horario || '';
      $scope.place.mail_distrib = $scope.place.mail || '';
      $scope.place.tel_distrib = $scope.place.telefono || '';
      $scope.place.web_distrib = $scope.place.web || '';
    } else {
      $scope.place.condones = false;
    }

    if ($scope.place.prueba) {
      $scope.place.responsable_testeo = $scope.place.responsable || '';
      $scope.place.horario_testeo = $scope.place.horario || '';
      $scope.place.mail_testeo = $scope.place.mail || '';
      $scope.place.tel_testeo = $scope.place.telefono || '';
      $scope.place.web_testeo = $scope.place.web || '';
      $scope.place.es_rapido =  $scope.place.pruebaRapida  == true;
    } else {
      $scope.place.prueba = false;
    }

    if ($scope.place.infectologia) {
      $scope.place.responsable_infectologia = $scope.place.responsable || '';
      $scope.place.horario_infectologia = $scope.place.horario || '';
      $scope.place.mail_infectologia = $scope.place.mail || '';
      $scope.place.tel_infectologia = $scope.place.telefono || '';
      $scope.place.web_infectologia = $scope.place.web || '';
    } else {
      $scope.place.infectologia = false;
    }

    if ($scope.place.vacunatorio) {
      $scope.place.responsable_vac = $scope.place.responsable || '';
      $scope.place.horario_vac = $scope.place.horario || '';
      $scope.place.mail_vac = $scope.place.mail || '';
      $scope.place.tel_vac = $scope.place.telefono || '';
      $scope.place.web_vac = $scope.place.web || '';
    } else {
      $scope.place.vacunatorio = false;
    }


    if ($scope.place.mac) {
      $scope.place.responsable_mac = $scope.place.responsable || '';
      $scope.place.horario_mac = $scope.place.horario || '';
      $scope.place.mail_mac = $scope.place.mail || '';
      $scope.place.tel_mac = $scope.place.telefono || '';
      $scope.place.web_mac = $scope.place.web || '';
    } else {
      $scope.place.mac = false;
    }

    if ($scope.place.ile) {
      $scope.place.responsable_ile = $scope.place.responsable || '';
      $scope.place.horario_ile = $scope.place.horario || '';
      $scope.place.mail_ile = $scope.place.mail || '';
      $scope.place.tel_ile = $scope.place.telefono || '';
      $scope.place.web_ile = $scope.place.web || '';
    } else {
      $scope.place.ile = false;
    }

    if ($scope.place.ssr) {
      $scope.place.responsable_ssr = $scope.place.responsable || '';
      $scope.place.horario_ssr = $scope.place.horario || '';
      $scope.place.mail_ssr = $scope.place.mail || '';
      $scope.place.tel_ssr = $scope.place.telefono || '';
      $scope.place.web_ssr = $scope.place.web || '';
    } else {
      $scope.place.ssr = false;
    }

    if ($scope.place.dc) {
      $scope.place.responsable_dc = $scope.place.responsable || '';
      $scope.place.horario_dc = $scope.place.horario || '';
      $scope.place.mail_dc = $scope.place.mail || '';
      $scope.place.tel_dc = $scope.place.telefono || '';
      $scope.place.web_dc = $scope.place.web || '';
    } else {
      $scope.place.dc = false;
    }

  }

  $scope.clicky = function() {
    $scope.formChange();
    if ($scope.invalid){
      Materialize.toast($scope.invalidReason, 5000);
      return;
    }
    $scope.invalid = true;
    $scope.spinerflag = true;

    processServices();
    var data = $scope.place;

    $http.post('api/v1/places', data)
      .then(
        function(response) {
            //console.log(response);
          $scope.spinerflag = false;
          if (response.data.length === 0) {
            Materialize.toast('¡Su peticion ha sido enviada!', 5000);
            $("button").remove();
            $("input").val("");
            document.location.href = $location.path();
          } else {
            for (var propertyName in response.data) {
              Materialize.toast("Tu sugerencia fue enviada, nos comunicaremos para confirmar los datos.", 20000);
            }
            $scope.spinerflag = false;
            $scope.formChange();
          }

        },
        function(response) {
            //console.log(response);
          Materialize.toast('Intenta nuevamente mas tarde.', 5000);
          $scope.invalid = false;
          $scope.spinerflag = false;

        });

  };

  placesFactory.getCountries(function(countries) {
    $scope.countries = countries;
  })

  $scope.loadCity = function() {
    $scope.showCity = true;
    placesFactory.getCitiesForPartidos({
      id: $scope.place.idPartido
    }, function(data) {
      $scope.cities = data;
    })

  };

  $scope.showProvince = function() {

    $scope.provinceOn = true;
    placesFactory.getProvincesForCountry($scope.place.idPais, function(data) {
      $scope.provinces = data;
    });

  }

  $scope.showPartido = function() {

    $scope.partidoOn = true;
    placesFactory.getPartidosForProvince($scope.place.idProvincia, function(data) {
      $scope.partidos = data;
    });

  }

});
