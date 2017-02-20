dondev2App.controller('evaluationController',
	function(NgMap,vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location, $routeParams, $window) {
    console.log('evaluationController');
    $scope.submiteable = false;
    $scope.voto = "";
    $scope.response = null;
    $scope.widgetId = null;
    // $scope.grecaptcha = 99;

    // console.log($scope.response)

    $scope.model = {
      key: '6Le6vhMUAAAAANvNw1nNOf6R_O8RuKFcCGv5IZzj'
    };

    $scope.setResponse = function (response) {
        // console.info('Response available');
        $scope.response = response;
        this.formChange();
    };

    $scope.setWidgetId = function (widgetId) {
        // console.info('Created widget ID: %s', widgetId);

        $scope.widgetId = widgetId;
    };

    $scope.cbExpiration = function() {
        console.info('Captcha expired. Resetting response object');

        vcRecaptchaService.reload($scope.widgetId);

        $scope.response = null;
     };
  
    // console.log('Cargo el return en');
    // console.log($rootScope.returnTo)
    

    // $scope.evaluation.captcha="";

    function submiteableServices() {
      var flagS = (
        ($scope.evaluation.informacion === true) || 
        ($scope.evaluation.test === true) || 
        ($scope.evaluation.pastillaA === true) || 
        ($scope.evaluation.pastillaDD === true) || 
        ($scope.evaluation.diu === true) || 
        ($scope.evaluation.inyectable === true) || 
        ($scope.evaluation.chip === true) || 
        ($scope.evaluation.condon === true) || 
        ($scope.evaluation.ligadura === true) || 
        ($scope.evaluation.vasectomia === true) || 
        ($scope.evaluation.otro === true) ); 
    
    return flagS;
        
    }
  
  
  function unCheckedCaptcha() {
    var flagC = true;
    // if (grecaptcha.getResponse().length == 0){
    if ($scope.response.length == 0){
      console.log('No checkeado captcha')
    }
    else{
      console.log('Si checkeado captcha')
      flagC = false;
    }

    return flagC;
  }

  // function test (response) {
  //   $scope.grecaptcha = response;
     // console.log(response); 
  // }



  function unSubmiteableForm() {
    var flagF = (
      // (grecaptcha.getResponse() === "") ||
      (typeof $scope.evaluation.le_dieron === "undefined") || ($scope.evaluation.le_dieron.length == 0) || 
      (typeof $scope.evaluation.info_ok === "undefined") || 
      (typeof $scope.evaluation.privacidad_ok === "undefined") ||
      (typeof $scope.evaluation.edad === "undefined") || ($scope.evaluation.edad === null) || 
      (typeof $scope.evaluation.genero === "undefined") ||  ($scope.evaluation.genero.length == 0) ||
      (typeof $scope.comment === "undefined") || ($scope.comment.Comment.body.length == 0) ||
      (typeof $scope.evaluation.voto === "undefined") );
    return flagF;
  }    




    $scope.formChange = function () {      
      if (unSubmiteableForm() || !submiteableServices() || unCheckedCaptcha() ){
        $scope.submiteable = false;
        // console.log('No es posible')
        // console.log(unCheckedCaptcha())
      }
      else{
        $scope.submiteable = true;
        // console.log('Ahora si')
        // console.log(unCheckedCaptcha())
      }
    }

    //para que funcione el select
    $(document).ready(function() {
        $('select').material_select();
    });
    
  
  var urlCopy = "api/v2/evaluacion/comentarios/" + $routeParams.id; 
   $http.get(urlCopy).then(foundBacon);
    function foundBacon(response) {
      // console.log('Copy evaluation establecimeito')
      $scope.establecimiento = response.data[0].establecimiento;      
   };
  

    $scope.iconList = [
        { id: '1', image: '1', imageDefault: '1', imageBacon: '1active', active: false, vote: 1 },
        { id: '2', image: '2', imageDefault: '2', imageBacon: '2active', active: false, vote: 2 },
        { id: '3', image: '3', imageDefault: '3', imageBacon: '3active', active: false, vote: 3 },
        { id: '4', image: '4', imageDefault: '4', imageBacon: '4active', active: false, vote: 4 },
        { id: '5', image: '5', imageDefault: '5', imageBacon: '5active', active: false, vote: 5 }];

    $scope.searchOption = [
        { value: 'Si', label: 'Sí' }, 
        { value: 'Si, aunque no me dieron todo lo que buscaba', label: 'Sí, aunque no me dieron todo lo que buscaba' }, 
        { value: 'No', label: 'No' }, 
        { value: 'No, estaba cerrado', label: 'No, estaba cerrado' }, 
        { value: 'No, me dieron turno para otro día', label: 'No, me dieron turno para otro día' }, 
        { value: 'Otra opción', label: 'Otra opción' }];

    $scope.genreOptions = [
        { value: 'Mujer', label: 'Mujer' }, 
        { value: 'Varón', label: 'Varón' }, 
        { value: 'Mujer trans', label: 'Mujer trans' }, 
        { value: 'Varón trans', label: 'Varón trans' }, 
        { value: 'Otro', label: 'Otro' }, 
        { value: 'Prefiero no contestar', label: 'Prefiero no contestar' }];

    // $scope.serviceItems = ['Informacion','Test de Embarazo','Pastillas anticonceptivas','Anticoncepción de emergencia (Pastilla del día después)','DIU','Anticoncepcíon inyectable','Implante subdérmico (chip)','Preservativos','Ligadura de trompas','Vasectomía','Otros (explicalo en Comentarios)'];
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
         // formChange();
         $scope.formChange();
      }

      $scope.cerrar = function () {

        // var valueToGo = $rootScope.returnTo; 
        // document.location.href=window.history.go(-valueToGo); 

        $window.location.reload();
        document.location.href=window.history.go(-4); 
      }

       $scope.clicky = function(evaluation) {
        console.log('ENTRO A CLICKY')
        $scope.evaluation.comentario = $scope.comment.Comment.body;
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
        $scope.evaluation.que_busca = queBuscaste.join(", ");

        var data = $scope.evaluation;
        if (data.privacidad_ok) data.privacidad_ok = parseInt(data.privacidad_ok);
        if (data.info_ok) data.info_ok = parseInt(data.info_ok);
        data.idPlace = $routeParams.id;

        $http.post('api/v2/evaluacion/votar', data)
        .then(function(response) {
         console.warn(response.data.length)
                if (response.data.length === 0) {
                    Materialize.toast('Calificación enviada!', 5000);
                    console.warn(data.idPlace);
                    document.location.href="#voted/"+data.idPlace;
                } else {
                    for (var propertyName in response.data) {
                        Materialize.toast(response.data[propertyName], 8000);
                    }
                } 
            },
            function(response) {
                // console.log('fallo')
                Materialize.toast('Intenta nuevamente mas tarde.', 5000);
            });
        queBuscaste = [];
    }


   
});