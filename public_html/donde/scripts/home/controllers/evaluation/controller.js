//recordar incorporarlo al index.htm!!
dondev2App.controller('evaluationController',
	function(NgMap,placesFactory, $scope, $rootScope, $http, $interpolate, $location, $routeParams) {

	console.log('evaluation controller')
    $scope.serviceItems = ['Informacion','Test de embarazo','Pastillas anticonceptivas','Anticoncepcíon de emergencia (pastilla del dia después)','DIU','Anticoncepcíon inyectable','Implante subdérmico (chip)','Presevativos','Ligadura de trompas','Vasectomia','Otros (explicalo en Comentarios)'];
    $scope.evaluation = {};
    $scope.evaluation.test = "Jona";

    $scope.color = {
        name: 'blue'
   	};
   	$scope.specialValue = {
        "id": "12345",
        "value": "green"
      };

    // $http.post('api/v2/evaluation', data)
    // .then(
    // 	function(response) {
    // 		$scope.spinerflag= false;
    // 		if (response.data.length === 0) {
    // 			Materialize.toast('Su peticion a sido enviada!', 5000);
    // 			// $("button").remove();
    // 			// $("input").val("");
    // 			document.location.href = $location.path();
    // 		} else {
    // 			// for (var propertyName in response.data) {
    // 				Materialize.toast(response.data[propertyName], 10000);
    // 			// }
    // 			// $scope.spinerflag = false;
    // 			// $scope.formChange();
    // 		}

    // 	},
    // 	function(response) {
    // 		Materialize.toast('Intenta nuevamente mas tarde.', 5000);
    // 		// $scope.invalid = false;
    // 		// $scope.spinerflag = false;

    // 	});


});
