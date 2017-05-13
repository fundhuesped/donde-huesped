dondev2App.controller('evaluationController',
	function(NgMap,vcRecaptchaService,placesFactory, $scope, $rootScope, $http, $interpolate, $location, $routeParams, $window, $compile) {
    console.log('evaluationController');
    $scope.submiteable = false;
    $scope.voto = "";
    $scope.response = null;
    $scope.widgetId = null;
		$scope.placeId = $routeParams.id;
		console.log("placeId : " + $scope.placeId);
		//$scope.services = [{"name":"Prueba VIH","shortname":"prueba"},{"name":"Condones","shortname":"condones"},{"name":"Vacunatorios","shortname":"vacunatorios"},{"name":"Centros de Infectología","shortname":"cdi"},{"name":"Servicios de Salud Sexual y Repoductiva","shortname":"ssr"},{"name":"Interrupción Legal del Embarazo","shortname":"ile"}];
    // $scope.grecaptcha = 99;
		$scope.selectedService = "";
		$scope.services = [];
		$scope.selectedServiceQuestions = [];
		$scope.questionsAndAnswers = [];
		$scope.evaluation = [];
		$scope.evaluation.responses = [];
		$scope.validForm = false;
		$scope.respuestas = {};
		$scope.voto = "";
		$scope.validCheckBoxes = [];
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

		/*
		$scope.getAllServices = function(){
			$http({
		  method: 'GET',
		  url: 'api/v2/service/getAllServices'
		}).then(function successCallback(response) {
				$scope.services = response.data;
				console.log("services");
				console.log($scope.services);
		  }, function errorCallback(response) {
		    console.log("error response " + response);
				Materialize.toast("Ha ocurrido un problema, inténtelo nuevamente mas tarde");
		  });
		};
		*/
		$scope.getServices = function(placeId){
			$http({
			method: 'GET',
			url: 'api/v2/service/getPlaceServices/' + placeId
		}).then(function successCallback(response) {
				$scope.services = response.data;
				console.log("services");
				console.log($scope.services);
			}, function errorCallback(response) {
				console.log("error response " + response);
				Materialize.toast("Ha ocurrido un problema, inténtelo nuevamente mas tarde");
			});
		};
		$scope.getAllQuestionsResponses();
		$scope.getServices($scope.placeId);
    $scope.model = {
      key: '6Le6vhMUAAAAANvNw1nNOf6R_O8RuKFcCGv5IZzj'
    };

    $scope.setResponse = function (response) {
        // console.info('Response available');
        $scope.captchaResponse = response;
				console.log("captcha response " + response);
        $scope.formValidator();
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




  function unCheckedCaptcha() {
    var flagC = true;
    // if (grecaptcha.getResponse().length == 0){
    if ((typeof $scope.captchaResponse === "undefined")  || ($scope.captchaResponse == null) || ($scope.captchaResponse.length == 0)){
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
	$scope.checkboxValidator = function(){
		var result = true;
		$scope.validCheckBoxes.forEach(function(checkbox){
			if (!checkbox) result = false;
		})
		return result;
	}

	$scope.formValidator = function() {
		if ((typeof $scope.evaluation.responses != "undefined") && ($scope.evaluation.responses.length == $scope.selectedServiceQuestions.length) && (!unCheckedCaptcha()) && ($scope.checkboxValidator())) $scope.validForm = true;
		else $scope.validForm = false;
		return $scope.validForm;
  }


    //para que funcione el select
    $(document).ready(function() {
        $('select').material_select();
    });


  var urlCopy = "api/v2/evaluacion/comentarios/" + $routeParams.id;
   $http.get(urlCopy).then(foundBacon);
    function foundBacon(response) {
       console.log('Copy evaluation establecimeito')
			 //console.log(response.data[0]);
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
         //$scope.evaluation.voto = $scope.iconList[pos].vote;
				 $scope.voto = $scope.iconList[pos].vote;
				 console.log("$scope.respuestas.voto : " + $scope.voto);
         // formChange();
         $scope.formValidator();
      }

      $scope.cerrar = function () {
        // $window.location.reload();
        window.history.go(-3);

      }

			$scope.clicky = function(evaluation) {

				$scope.respuestas = {};
				$scope.respuestas.que_busca = "";
				var qId;
				var index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("que_busca");
				if (index >= 0) {
						$scope.evaluation.responses[index].options.forEach(function(selectedOption) {
								queBuscaste.push(selectedOption.optionBody);
						/*	if ($scope.respuestas.que_busca.length == 0) $scope.respuestas.que_busca = selectedOption.optionBody;
							else $scope.respuestas.que_busca += ',' + selectedOption.optionBody;*/
						})
						$scope.respuestas.que_busca = queBuscaste.join(", ");
				}
				console.log("$scope.respuestas.que_busca : " + $scope.respuestas.que_busca);


				$scope.respuestas.le_dieron = "";
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("le_dieron");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.le_dieron = $("#selectbox_" + qId + " option:selected").text();
				}

				console.log("$scope.respuestas.le_dieron : " + $scope.respuestas.le_dieron);


				$scope.respuestas.privacidad_ok = "";
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("privacidad_ok");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.privacidad_ok = $scope.responses[qId];
						if ($scope.respuestas.privacidad_ok.length > 0) {
								if ($scope.respuestas.privacidad_ok.toLowerCase() == "si") $scope.respuestas.privacidad_ok = 1;
								else $scope.respuestas.privacidad_ok = 0;

						} else console.log("$scope.respuestas.privacidad_ok.length  no es > 0");
				}
				console.log("$scope.respuestas.privacidad_ok : " + $scope.respuestas.privacidad_ok);

				$scope.respuestas.info_ok = "";
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("info_ok");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.info_ok = $scope.responses[qId];
						if ($scope.respuestas.info_ok.length > 0) {
								if ($scope.respuestas.info_ok.toLowerCase() == "si") $scope.respuestas.info_ok = 1;
								else $scope.respuestas.info_ok = 0;

						} else console.log("$scope.respuestas.info_ok.length  no es > 0");
				}
				console.log("$scope.respuestas.info_ok : " + $scope.respuestas.info_ok);

				$scope.respuestas.edad = "";
					index = $scope.evaluation.responses.map(function(questions) {
							return questions.evaluation_column;
					}).indexOf("edad");
					if (index >= 0) {
						console.log("entro en index edad > 0");
							qId = $scope.evaluation.responses[index].questionId;
						//	$scope.respuestas.edad = $("#number_" + qId).val();
							$scope.respuestas.edad = $("#selectbox_" + qId + " option:selected").text();

					}
					else console.log("index edad NO ES > 0");
					console.log("$scope.respuestas.edad : " + $scope.respuestas.edad);
				/*
								var data = $scope.evaluation;
								if (data.privacidad_ok) data.privacidad_ok = parseInt(data.privacidad_ok);
								if (data.info_ok) data.info_ok = parseInt(data.info_ok);
								//data.idPlace = $routeParams.id;
				*/

				$scope.respuestas.genero = "";
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("genero");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						//$scope.respuestas.genero = $scope.responses[qId];
						$scope.respuestas.genero = $("#selectbox_" + qId + " option:selected").text();
				}
				console.log("$scope.respuestas.genero : " + $scope.respuestas.genero);


				$scope.respuestas.es_gratuito = 0;
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("es_gratuito");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.es_gratuito = $scope.responses[qId];
						if ($scope.respuestas.es_gratuito.length > 0) {
								if ($scope.respuestas.es_gratuito.toLowerCase() == "si") $scope.respuestas.es_gratuito = 1;
								else $scope.respuestas.es_gratuito = 0;

						} else console.log("$scope.respuestas.es_gratuito.length  no es > 0");
				}
				console.log("$scope.respuestas.es_gratuito : " + $scope.respuestas.es_gratuito);


				$scope.respuestas.comodo = 0;
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("comodo");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.comodo = $scope.responses[qId];
						if ($scope.respuestas.comodo.length > 0) {
								if ($scope.respuestas.comodo.toLowerCase() == "si") $scope.respuestas.comodo = 1;
								else $scope.respuestas.comodo = 0;

						} else console.log("$scope.respuestas.comodo.length  no es > 0");
				}
				console.log("$scope.respuestas.comodo : " + $scope.respuestas.comodo);



				$scope.respuestas.informacion_vacunas = 0;
				index = $scope.evaluation.responses.map(function(questions) {
						return questions.evaluation_column;
				}).indexOf("informacion_vacunas");
				if (index >= 0) {
						qId = $scope.evaluation.responses[index].questionId;
						$scope.respuestas.informacion_vacunas = $scope.responses[qId];
						if ($scope.respuestas.informacion_vacunas.length > 0) {
								if ($scope.respuestas.informacion_vacunas.toLowerCase() == "si") $scope.respuestas.informacion_vacunas = 1;
								else $scope.respuestas.informacion_vacunas = 0;

						} else console.log("$scope.respuestas.informacion_vacunas.length  no es > 0");
				}
				console.log("$scope.respuestas.informacion_vacunas : " + $scope.respuestas.informacion_vacunas);

				$scope.respuestas.idPlace = $routeParams.id;
				console.log("$scope.respuestas.idPlace : " +  $scope.respuestas.idPlace);
				$scope.respuestas.voto = $scope.voto;
				console.log("$scope.respuestas.voto : " + $scope.respuestas.voto);

				$scope.respuestas.service = $scope.selectedService;
				$scope.services.forEach(function(service) {
						if (service.id == $scope.respuestas.service){
							$scope.respuestas.serviceShortName = service.shortname.toLowerCase();
							console.log(" $scope.respuestas.serviceShortName  " +  $scope.respuestas.serviceShortName );
						}
				})
				console.log("$scope.respuestas.service : " + $scope.respuestas.service);
				$scope.respuestas.comments = $("#comments").val();
				console.log("$scope.respuestas.comments : " + $("#comments").val());
				console.log("$scope.respuestas ");
				console.log($scope.respuestas);
				$http.post('api/v2/evaluacion/votar', $scope.respuestas)
						.then(function(response) {
										console.log("response.data");
										console.log(response.data);
										if (response.data.length === 0) {
												Materialize.toast('Calificación enviada!', 5000);
												document.location.href = "#voted/" + $scope.respuestas.idPlace;
												queBuscaste = [];
												$scope.responses = [];
												$scope.selectedServiceQuestions = [];
												$scope.evaluation.responses = [];
												$scope.respuestas = {};
										} else {
											/*	for (var propertyName in response.data) {
														Materialize.toast(response.data[propertyName], 8000);
												}*/
										}
								},
								function(response) {
										// console.log('fallo')
										Materialize.toast('Intenta nuevamente mas tarde.', 5000);
								});

		}

$scope.actualQuestion={};

$scope.selectedServiceChange = function() {
	queBuscaste = [];
	$scope.responses = [];
	$scope.evaluation.responses = [];
	$scope.respuestas = {};
  $scope.selectedServiceQuestions = [];
    // Materialize.toast($scope.selectedService);

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
                //var htmlTitleSelectBox = '<div class="block"><p class="blockTitle">' + question.body + ' </p><select class="blockContent browser-default right-alert" ng-model="evaluation.responses[' + question.id + ']" ng-change="responseChange(' + question.id + ','+ question.body +')" id="selectbox_' + $scope.cont + '">';
								var htmlTitleSelectBox = '<div class="block"><p class="blockTitle">' + question.body + ' </p><select class="blockContent browser-default right-alert" ng-model="responses['+ question.id +']" ng-change="selectBoxChange(' + question.id + ',\'' + question.evaluation_column + '\')" id="selectbox_' + question.id + '">';
                var appendHtml = $compile(htmlTitleSelectBox)($scope);
								//<option value="default" selected="selected">Selecciona una opción</option>'
                $("#evaluation").append(appendHtml);
								//$("#selectbox_" + question.id).append('');
							//	$("#selectbox_" + question.id).val("default").prop('selected', true).change();
							$('#selectbox_' + question.id + ' option[value="default"]').attr('selected', 'selected');
							$('#selectbox_' + question.id + ' option[value=default]').prop('selected', 'selected');
                question.options.forEach(function(option) {
                    var optionsHtml = '<option value="' + option.id + '">' + option.body + '</option> </select></div>';
                    var appendHtml = $compile(optionsHtml)($scope);
                    $("#selectbox_" + question.id).append(appendHtml);
                });
            } else if (question.type == 'checkbox') {
                var tittle = '<div class="block"><p class="blockTitle">' + question.body + '</p><p class="blockContent" id="checkbox_' + $scope.cont + '">';

                $("#evaluation").append(tittle);
                question.options.forEach(function(option) {
                    var optionsHtml = '<input type="checkbox" name="' + question.id + '"  id="' + question.id + '' + option.id + '" value="' +
                    option.id + '" ng-model="responses[' + question.id + '][' + option.id + ']" ng-change="checkBoxChange(' + question.id + ',' + option.id + ',\'' + question.evaluation_column + '\',\'' + option.body + '\')"/><label for="' + question.id + '' + option.id + '">' + option.body + '</label></p></div><br>';
                    var appendHtml = $compile(optionsHtml)($scope);
                    $("#checkbox_" + $scope.cont).append(appendHtml);
                });
                //<input type="checkbox" name="[[::actualQuestion.id]]"  id="[[actualQuestion.id]][[option.id]]" value="option.id" ng-model="respuestas"  ng-change="responseChange()"/><label for="[[actualQuestion.id]][[option.id]]">[[cont]]</label></p></div><br>'
                //$( "#evaluation" ).append(appendHtml);
                //	var appendHtml = $compile('<check-Box></check-Box>')($scope);
            } else if (question.type == 'radiobox') {
                var tittle = '<div class="block"><p class="blockTitle">' + question.body + '</p><p class="blockContent" id="radiobox_' + question.id + '">';
                $("#evaluation").append(tittle);
                question.options.forEach(function(option) {
									var optionsHtml = '<input id="' + question.id + '' + option.id + '" ng-model="responses[' + question.id + ']" class="with-gap" name="' + question.id + '" type="radio" value="' + option.body + '"  ng-change="radioBoxChange(' + question.id + ',\'' + question.evaluation_column + '\')"/><label for="' + question.id + '' + option.id + '">' + option.body + '</label>'
                  var appendHtml = $compile(optionsHtml)($scope);
                  $("#radiobox_" + question.id).append(appendHtml);
                });
                //<input type="checkbox" name="[[::actualQuestion.id]]"  id="[[actualQuestion.id]][[option.id]]" value="option.id" ng-model="respuestas"  ng-change="responseChange()"/><label for="[[actualQuestion.id]][[option.id]]">[[cont]]</label></p></div><br>'
                //$( "#evaluation" ).append(appendHtml);
                //	var appendHtml = $compile('<check-Box></check-Box>')($scope);
            } else if (question.type == 'number') {
								var htmlQuestion =	'<div class="block"><p class="blockTitle">' + question.body + '</p>	 <div class="blockContent"><input type="number" name="edad" id="number_' + question.id + '" placeholder="Escribí en números" ng-model="responses[' + question.id + ']" class="validate" ng-change="numberBoxChange(' + question.id + ',\'' + question.evaluation_column + '\')" required="required"/>						  </div></div>'
                var appendHtml = $compile(htmlQuestion)($scope);
                $("#evaluation").append(appendHtml);
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


$scope.checkBoxChange = function(questionId, optionId, evaluation_column, optionBody){
	console.log("questionId selected");
	console.log(questionId);
	console.log("evaluation_column");
	console.log(evaluation_column);
	if ((typeof $scope.evaluation.responses != "undefined") && ($scope.evaluation.responses != "null") && ($scope.evaluation.responses.length > 0)){
			console.log("responses.lenght > 0");
		var index = $scope.evaluation.responses.map(function(questions) { return questions.questionId; }).indexOf(questionId);
		console.log("map index " + index);
		if (index >= 0){
				console.log("index > 0 : " + index );
		//	var indexAux = $scope.evaluation.responses[index].options.indexOf(optionId);
			var indexAux = $scope.evaluation.responses[index].options.map(function(option) { return option.optionId; }).indexOf(optionId);
			if (indexAux >= 0) {
				console.log("indexAux > 0 " + indexAux );
				$scope.evaluation.responses[index].options.splice(indexAux, 1);
				if (($scope.evaluation.responses[index].options.length != 0)) $scope.validCheckBoxes[questionId] = true;
				else $scope.validCheckBoxes[questionId] = false;
			}
			else{
				$scope.evaluation.responses[index].options.push({'optionId':optionId, 'optionBody': optionBody});
				if (($scope.evaluation.responses[index].options.length != 0)) $scope.validCheckBoxes[questionId] = true;
				else $scope.validCheckBoxes[questionId] = false;
			}
		}
		else {
			$scope.evaluation.responses.push({'questionId': questionId, 'questionType': 'checkbox','evaluation_column': evaluation_column, 'options': [{'optionBody':optionBody,'optionId':optionId}]});
			$scope.validCheckBoxes[questionId] = true;
		}
	}
	else {
		$scope.evaluation.responses = [{'questionId': questionId, 'questionType': 'checkbox', 'evaluation_column': evaluation_column,'options': [{'optionBody':optionBody,'optionId':optionId}]}];
		$scope.validCheckBoxes[questionId] = true;
	}

	console.log("$scope.evaluation.responses");
	console.log($scope.evaluation.responses);
	$scope.formValidator();
	//var f = $("#" + questionId + '_' + optionId).val();
	//console.log("f " + f);
}

$scope.selectBoxChange = function(questionId, evaluation_column){
	//var resp = $('input[name="' + aux + '"]:checked').val();
	console.log("questionId selected");
	console.log(questionId);
	if ((typeof $scope.evaluation.responses != "undefined") && ($scope.evaluation.responses != "null") && ($scope.evaluation.responses.length > 0)){
		console.log("responses.lenght > 0");
		var index = $scope.evaluation.responses.map(function(questions) { return questions.questionId; }).indexOf(questionId);
		console.log("map index " + index);
		if (index >= 0){
			console.log("index > 0");
			$scope.evaluation.responses[index].questionId = questionId;
			$scope.evaluation.responses[index].questionType = "selectbox";
			$scope.evaluation.responses[index].evaluation_colmun = evaluation_column;
			$scope.evaluation.responses[index].options[0] = $scope.responses[questionId];
		}
		else $scope.evaluation.responses.push({'questionId': questionId, 'questionType': 'selectbox', 'evaluation_column': evaluation_column, 'options': [$scope.responses[questionId]]});
	}
	else $scope.evaluation.responses = [{'questionId': questionId, 'questionType': 'selectbox' , 'evaluation_column': evaluation_column,'options': [$scope.responses[questionId]]}];

	console.log("$scope.evaluation.responses");
	console.log($scope.evaluation.responses);
	$scope.formValidator();
	//var f = $("#" + questionId + '_' + optionId).val();
	//console.log("f " + f);
}

$scope.radioBoxChange = function(questionId, evaluation_column){
	//var resp = $('input[name="' + aux + '"]:checked').val();
	console.log("questionId selected");
	console.log(questionId);
	if ((typeof $scope.evaluation.responses != "undefined") && ($scope.evaluation.responses != "null") && ($scope.evaluation.responses.length > 0)){
		console.log("responses.lenght > 0");
		var index = $scope.evaluation.responses.map(function(questions) { return questions.questionId; }).indexOf(questionId);
		console.log("map index " + index);
		if (index >= 0){
			console.log("index > 0");
			$scope.evaluation.responses[index].questionId = questionId;
			$scope.evaluation.responses[index].questionType = "rabiobox";
			$scope.evaluation.responses[index].evaluation_column = evaluation_column;
			$scope.evaluation.responses[index].options[0] = $scope.responses[questionId];
		}
		else $scope.evaluation.responses.push({'questionId': questionId, 'questionType': 'rabiobox', 'evaluation_column': evaluation_column,'options': [$scope.responses[questionId]]});
	}
	else $scope.evaluation.responses = [{'questionId': questionId, 'questionType': 'rabiobox' , 'evaluation_column': evaluation_column,'options': [$scope.responses[questionId]]}];

	console.log("$scope.evaluation.responses");
	console.log($scope.evaluation.responses);
	//var f = $("#" + questionId + '_' + optionId).val();
	//console.log("f " + f);
	$scope.formValidator();
}

$scope.numberBoxChange = function(questionId, evaluation_column){
	//var resp = $('input[name="' + aux + '"]:checked').val();
	console.log("value");
	var number = $("#number_" + questionId).val();
	console.log(number);
	console.log("cuestionId " + questionId);
	if ((typeof $scope.evaluation.responses != "undefined") && ($scope.evaluation.responses != "null") && ($scope.evaluation.responses.length > 0)){
		console.log("responses.lenght > 0");
		var index = $scope.evaluation.responses.map(function(questions) { return questions.questionId; }).indexOf(questionId);
		console.log("map index " + index);
		if (index >= 0){
			console.log("entra por index >= 0");
			$scope.evaluation.responses[index] = {'questionId': questionId, 'questionType': 'number' ,'evaluation_column': evaluation_column, 'options': [number]};
		}
		else{
			console.log("entra por index < 0");
			$scope.evaluation.responses.push({'questionId': questionId, 'questionType': 'number' ,'evaluation_column': evaluation_column,'options': [number]});
		}
	}
	else{
		console.log("entra por scope undefined");
		$scope.evaluation.responses = [{'questionId': questionId, 'questionType': 'number', 'evaluation_column': evaluation_column,'options': [number]}];
	}

	console.log("$scope.evaluation.responses");
	console.log($scope.evaluation.responses);
	$scope.formValidator();
	//var f = $("#" + questionId + '_' + optionId).val();
	//console.log("f " + f);
}

});


dondev2App.directive('checkBox', function() {
  return {

    templateUrl: './scripts/home/controllers/evaluation/my-checkbox.html'
}
});
