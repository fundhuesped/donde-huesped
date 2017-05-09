dondev2App.controller('evaluationController',
	function(NgMap,vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location, $routeParams, $window, $compile) {
    console.log('evaluationController');
    $scope.submiteable = false;
    $scope.voto = "";
    $scope.response = null;
    $scope.widgetId = null;
		//$scope.services = [{"name":"Prueba VIH","shortname":"prueba"},{"name":"Condones","shortname":"condones"},{"name":"Vacunatorios","shortname":"vacunatorios"},{"name":"Centros de Infectología","shortname":"cdi"},{"name":"Servicios de Salud Sexual y Repoductiva","shortname":"ssr"},{"name":"Interrupción Legal del Embarazo","shortname":"ile"}];
    // $scope.grecaptcha = 99;
		$scope.selectedService = "";
		$scope.services = [];
		$scope.selectedServiceQuestions = [];
		$scope.questionsAndAnswers = [];
		$scope.evaluation = [];
		$scope.getAllQuestionsResponses = function(){
			$http({
		  method: 'GET',
		  url: 'api/v2/evaluacion/getallquestionsresponses'
		}).then(function successCallback(response) {
		    console.log("questions response ");
				console.log(response.data);
				$scope.questionsAndAnswers = response.data;
		  }, function errorCallback(response) {
		    // called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
		};
		$scope.getAllServices = function(){
			$http({
		  method: 'GET',
		  url: 'api/v2/service/getAllServices'
		}).then(function successCallback(response) {
				$scope.services = response.data;
				console.log("services");
				console.log($scope.services);
		  }, function errorCallback(response) {
		    // called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
		};
		$scope.getAllQuestionsResponses();
		$scope.getAllServices();
    $scope.model = {
      key: '6Le6vhMUAAAAANvNw1nNOf6R_O8RuKFcCGv5IZzj'
    };
/*
    $scope.setResponse = function (response) {
        // console.info('Response available');
        $scope.response = response;
        this.formChange();
    };
*/
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
      (typeof $scope.evaluation.service === "undefined") || (typeof $scope.evaluation.edad === "undefined") || ($scope.evaluation.edad === null) ||
      (typeof $scope.evaluation.genero === "undefined") ||  ($scope.evaluation.genero.length == 0) ||
      (typeof $scope.comment === "undefined") || ($scope.comment.Comment.body.length == 0) ||
      (typeof $scope.evaluation.voto === "undefined") )
    return flagF;
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
        // document.location.href = $window.history.go(-4);
      }

       $scope.clicky = function(evaluation) {
        // console.log('ENTRO A CLICKY')
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



$scope.actualQuestion={};

$scope.selectedServiceChange = function() {
    $scope.selectedServiceQuestions = [];
    Materialize.toast($scope.selectedService);

    $("#evaluation").empty();
    //var divElement = angular.element(document.querySelector('#evaluation'));
    $scope.cont = 0;
    var aux = false;
    $scope.questionsAndAnswers.forEach(function(question) {
        aux = false;
        question.services.forEach(function(service) {
            if (service.id == $scope.selectedService) aux = true;
        });
        console.log("aux : " + aux);
        if (aux) {
            $scope.selectedServiceQuestions.push(question);
            console.log("question.type : " + question.type);
            if (question.type == 'selectbox') {
                var htmlTitleSelectBox = '<div class="block"><p class="blockTitle">' + question.body + ' </p><select class="blockContent browser-default right-alert" ng-model="evaluation.responses[' + question.id + ']" ng-change="responseChange()" id="selectbox_' + $scope.cont + '">';
                var appendHtml = $compile(htmlTitleSelectBox)($scope);
                $("#evaluation").append(appendHtml);
                $("#selectbox_" + $scope.cont).append('<option value="default" default selected>Selecciona una opción</option>');
                question.options.forEach(function(option) {
                    var optionsHtml = '<option value="' + option.id + '">' + option.body + '</option> </select></div>';
                    var appendHtml = $compile(optionsHtml)($scope);
                    $("#selectbox_" + $scope.cont).append(appendHtml);
                });
                $("#selectbox_" + $scope.cont).val("default").attr("selected", "selected");
            } else if (question.type == 'checkbox') {
                var tittle = '<div class="block"><p class="blockTitle">' + question.body + '</p><p class="blockContent" id="checkbox_' + $scope.cont + '">';

                $("#evaluation").append(tittle);
                question.options.forEach(function(option) {
                    var optionsHtml = '<input type="checkbox" name="' + question.id + '"  id="' + question.id + '' + option.id + '" value="' + option.id + '" ng-model="evaluation.responses[' + question.id + '][' + option.id + ']" ng-change="responseChange()"/><label for="' + question.id + '' + option.id + '">' + option.body + '</label></p></div><br>';
                    var appendHtml = $compile(optionsHtml)($scope);
                    $("#checkbox_" + $scope.cont).append(appendHtml);
                });
                //<input type="checkbox" name="[[::actualQuestion.id]]"  id="[[actualQuestion.id]][[option.id]]" value="option.id" ng-model="respuestas"  ng-change="responseChange()"/><label for="[[actualQuestion.id]][[option.id]]">[[cont]]</label></p></div><br>'
                //$( "#evaluation" ).append(appendHtml);
                //	var appendHtml = $compile('<check-Box></check-Box>')($scope);
            } else if (question.type == 'radiobox') {
                var tittle = '<div class="block"><p class="blockTitle">' + question.body + '</p><p class="blockContent" id="radiobox_' + $scope.cont + '">';
                $("#evaluation").append(tittle);
                question.options.forEach(function(option) {
									var optionsHtml = '<input id="' + question.id + '' + option.id + '" ng-model="evaluation.responses[' + question.id + '][' + option.id + ']" class="with-gap" name="' + question.id + '" type="radio" value="' + option.id + '"  ng-change="responseChange()"/><label for="' + question.id + '' + option.id + '">' + option.body + '</label>'
                  var appendHtml = $compile(optionsHtml)($scope);
                  $("#radiobox_" + $scope.cont).append(appendHtml);
                });
                //<input type="checkbox" name="[[::actualQuestion.id]]"  id="[[actualQuestion.id]][[option.id]]" value="option.id" ng-model="respuestas"  ng-change="responseChange()"/><label for="[[actualQuestion.id]][[option.id]]">[[cont]]</label></p></div><br>'
                //$( "#evaluation" ).append(appendHtml);
                //	var appendHtml = $compile('<check-Box></check-Box>')($scope);
            };
            if (question.type == 'text') {
                var appendHtml = $compile('<div radio-Box></div>')($scope);
            };
            //divElement.append(appendHtml);
            console.log("question ");
            console.log(question);

            $scope.cont++;
        };
    });
}

$scope.responseChange = function(){
	//var resp = $('input[name="' + aux + '"]:checked').val();
	console.log("evaluation.response");
	console.log($scope.evaluation.responses);

	//var f = $("#" + questionId + '_' + optionId).val();
	//console.log("f " + f);
}


});

/*
dondev2App.directive('selectBox', function() {
  return {
		scope: {
         actualQuestion: '@',

      },
//    templateUrl: './scripts/home/controllers/evaluation/my-selectbox.html'
	transclude: true,
	templateUrl:'<div class="block"><p class="blockTitle">[[selectedServiceQuestions[0].body]]</p><p ng-transclude class="blockContent" ng-repeat="option in selectedServiceQuestions[0].options"><input type="checkbox"  name="[[selectedServiceQuestions[0].id]]" value="[[option.id]]" ng-change="formChange()"/>[[selectedServiceQuestions[0].id]]</p></div><br>'
  };
});
*/
dondev2App.directive('checkBox', function() {
  return {

    templateUrl: './scripts/home/controllers/evaluation/my-checkbox.html'
}
});
