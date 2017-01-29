dondev2App.controller('evaluationController',
	function(NgMap,vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location, $routeParams) {
    //para que funcione el select
    console.log('evaluationController');

    $(document).ready(function() {
        $('select').material_select();
    });
    
  var urlCopy = "api/v2/evaluacion/comentarios/" + $routeParams.id;
   $http.get(urlCopy).then(foundBacon);
    function foundBacon(response) {
      console.log('Copy evaluation establecimeito')
      $scope.establecimiento = response.data[0].establecimiento;      
   };
  
  // var urlCount = "api/v2/evaluacion/cantidad/" + $routeParams.id;
  // $http.get(urlCount)
  //   .then(function(response) {
  //     console.log('Entro al count')
  //     console.log(response)
  //       $scope.currentMarker.votes = response.data[0]; 
  //   });


    $scope.iconList = [
        { id: '1', image: '1', imageDefault: '1', imageBacon: '1active', active: false, vote: 1 },
        { id: '2', image: '2', imageDefault: '2', imageBacon: '2active', active: false, vote: 2 },
        { id: '3', image: '3', imageDefault: '3', imageBacon: '3active', active: false, vote: 3 },
        { id: '4', image: '4', imageDefault: '4', imageBacon: '4active', active: false, vote: 4 },
        { id: '5', image: '5', imageDefault: '5', imageBacon: '5active', active: false, vote: 5 }];

    $scope.searchOption = [
        { value: 'Si', label: 'Si' }, 
        { value: 'Si, aunque no me dieron todo lo que buscaba', label: 'Si, aunque no me dieron todo lo que buscaba' }, 
        { value: 'No', label: 'No' }, 
        { value: 'No, estaba cerrado', label: 'No, estaba cerrado' }, 
        { value: 'No, me dieron turno para otro día', label: 'No, me dieron turno para otro día' }, 
        { value: 'Otra opción', label: 'Otra opción' }];

    $scope.genreOptions = [
        { value: 'Mujer', label: 'Mujer' }, 
        { value: 'Varón', label: 'Varón' }, 
        { value: 'Muejer trans', label: 'Muejer trans' }, 
        { value: 'Varón trans', label: 'Varón trans' }, 
        { value: 'Otro', label: 'Otro' }, 
        { value: 'Prefiero no contestar', label: 'Prefiero no contestar' }];

    $scope.serviceItems = ['Informacion','Test de embarazo','Pastillas anticonceptivas','Anticoncepcíon de emergencia (pastilla del dia después)','DIU','Anticoncepcíon inyectable','Implante subdérmico (chip)','Presevativos','Ligadura de trompas','Vasectomia','Otros (explicalo en Comentarios)'];
    $scope.evaluation = {};
    var queBuscaste = [];
    


      $scope.setVote = function (id) { 
         var pos = 0;   
         for (var i = 0; i < $scope.iconList.length; i++) {
            $scope.iconList[i].active = false;
            $scope.iconList[i].image = $scope.iconList[i].imageDefault;
            if ($scope.iconList[i].id == id) pos = i;
         }
         console.warn("seleccionado pos:" + pos+ "Valor de voto:" + $scope.iconList[pos].vote);
         $scope.iconList[pos].active = true;
         $scope.iconList[pos].image = $scope.iconList[pos].imageBacon;
         $scope.evaluation.voto = $scope.iconList[pos].vote;
      }



       $scope.clicky = function() {

        if ($scope.evaluation.informacion === true) queBuscaste.push("Información"); 
        if ($scope.evaluation.test === true) queBuscaste.push("Test de Embarazao"); 
        if ($scope.evaluation.pastillaA === true) queBuscaste.push("Pastillas anticonceptivas"); 
        if ($scope.evaluation.pastillaDD === true) queBuscaste.push("Anticoncepcíon de emergencia"); 
        if ($scope.evaluation.diu === true) queBuscaste.push("DIU"); 
        if ($scope.evaluation.inyectable === true) queBuscaste.push("Anticoncepcíon inyectable"); 
        if ($scope.evaluation.chip === true) queBuscaste.push("Implante subdérmico"); 
        if ($scope.evaluation.condon === true) queBuscaste.push("Preservativos"); 
        if ($scope.evaluation.ligadura === true) queBuscaste.push("Ligadura de trompas"); 
        if ($scope.evaluation.vasectomia === true) queBuscaste.push("Vasectomia"); 
        if ($scope.evaluation.otro === true) queBuscaste.push("Otros"); 
        

        // var services = queBuscaste.join(); //aca tengo listo para para mostrar
        $scope.evaluation.que_busca = queBuscaste.join();

        var data = $scope.evaluation;
        if (data.privacidad_ok) data.privacidad_ok = parseInt(data.privacidad_ok);
        if (data.info_ok) data.info_ok = parseInt(data.info_ok);
        data.idPlace = $routeParams.id;
  

        $http.post('api/v2/evaluacion/votar', data)
        .then(function(response) {
         console.warn(response.data.length)
                if (response.data.length === 0) {
                    Materialize.toast('Calificación enviada!', 5000);
                    document.location.href="#voted";
                } else {
                    for (var propertyName in response.data) {
                        Materialize.toast(response.data[propertyName], 8000);
                    }
                } 
            },
            function(response) {
                console.log('fallo')
                Materialize.toast('Intenta nuevamente mas tarde.', 5000);
            });
        queBuscaste = [];
    }


   
});





/*    $scope.searchOption = [{
        value: '1',
        label: 'Si'
      }, {
        value: '2',
        label: 'Si, aunque no me dieron todo lo que buscaba'
      }, {
        value: '3',
        label: 'No'
      }, {
        value: '4',
        label: 'No, estaba cerrado'
      }, {
        value: '5',
        label: 'No, me dieron turno para otro día'
      }, {
        value: '6',
        label: 'Otra opción'
      }];

      $scope.genreOptions = [{
        value: '1',
        label: 'Mujer'
      }, {
        value: '2',
        label: 'Varón'
      }, {
        value: '3',
        label: 'Muejer trans'
      }, {
        value: '4',
        label: 'Varón trans'
      }, {
        value: '5',
        label: 'Otro'
      }, {
        value: '6',
        label: 'Prefiero no contestar'
      }]; */