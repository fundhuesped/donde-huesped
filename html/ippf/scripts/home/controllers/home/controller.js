dondev2App.controller('homeController',
	function($timeout,copyService, placesFactory,NgMap, $anchorScroll, $scope, $rootScope, $routeParams, $location, $http, $translate){
$rootScope.selectedLanguage;
try {
console.log(" localStorage.getItem('lang')");
console.log(localStorage.lang);

	 if (typeof localStorage.lang !== "undefined") {
		 console.log("asdda");
		 $http.get('changelang/' + localStorage.lang)
		 .then(
			 function(response) {
				 console.log("response");
				 console.log(response);
				 if (response.statusText == 'OK'){
					  $translate.use(localStorage.getItem("lang"));
						console.log("language changed");
				 }
				 else {
				 		Materialize.toast('Intenta nuevamente mas tarde.', 5000);
				 }
	},
		function(response) {
			Materialize.toast('Intenta nuevamente mas tarde.', 5000);
		});
	 }
	 else{
		 console.log("entra else");
		 var userLang = navigator.language || navigator.userLanguage; // es-AR
		 var userLang = userLang.split('-')[0]; // es
		 localStorage.setItem("lang", userLang);
			$translate.use(userLang);
	 }

 }
 catch(err) {
		 console.log('No soporta localstorage')
		 console.log(err);
		 if (typeof(err) !== "undefined") {
			 localStorage.setItem("lang", "es");
		 }
 }


//$rootScope.selectedLanguage = 'es';
$rootScope.changeLanguage = function(){
	console.log("changing language to " + $rootScope.selectedLanguage);
	localStorage.setItem("lang", $rootScope.selectedLanguage);
	$translate.use($rootScope.selectedLanguage);

	$http.get('changelang/' + localStorage.lang)
	.then(
		function(response) {
			console.log("response");
			console.log(response);
			if (response.statusText == 'OK'){
				 $translate.use(localStorage.getItem("lang"));
				 console.log("language changed");
			}
			else {
				 Materialize.toast('Intenta nuevamente mas tarde.', 5000);
			}
},
 function(response) {
	 Materialize.toast('Intenta nuevamente mas tarde.', 5000);
 });

	//$translate.refresh();
}

	$timeout(
		function() {
			$rootScope.moveMapTo = {
      latitude:-12.382928338487396,
      longitude:-79.27734375,
      zoom:3
    };
  },500);
		$rootScope.places = [];
	$rootScope.navigating = false;
	$scope.currentMarker = undefined;

	$rootScope.main = true;
	$rootScope.navBar = ""
	$scope.collapsibleElements = copyService.getAll();
	//console.log($scope.collapsibleElements);
});
