dondev2App.controller('homeController',
  function($timeout, copyService, placesFactory, NgMap, $anchorScroll, $scope, $rootScope, $routeParams, $location, $http, $translate) {
    $rootScope.selectedLanguage;
    try {
			console.log("navigator.language " + navigator.language);
			console.log("navigator.userLanguage " + navigator.userLanguage);
      var userLang = navigator.language || navigator.userLanguage; // es-AR
      var userLang = userLang.split('-')[0]; // es
			console.log("userLang");
			console.log(userLang);
			if (userLang !== 'undefined' && userLang.length > 0 && userLang != null){
				if (userLang == 'pt') userLang = 'br';
				localStorage.setItem("lang", userLang);
	      $translate.use(userLang);
			}else {
				console.log("localStorage.getItem('lang')");
				console.log(localStorage.lang);

	      if (typeof localStorage.lang !== "undefined") {
	        $http.get('changelang/' + localStorage.lang)
	          .then(
	            function(response) {
	              console.log("response");
	              console.log(response);
	              if (response.statusText == 'OK') {
	                $translate.use(localStorage.getItem("lang"));
	                console.log("language set " + localStorage.getItem("lang"));
	              } else {
	                Materialize.toast('Intenta nuevamente mas tarde.', 5000);
	              }
	            },
	            function(response) {
	              Materialize.toast('Intenta nuevamente mas tarde.', 5000);
	            });
	      } else {
					localStorage.setItem("lang", 'es');
		      $translate.use('es');
				}
			}
    } catch (err) {
      console.log('No soporta localstorage')
      console.log(err);
      if (typeof(err) !== "undefined") {
        localStorage.setItem("lang", "es");
      }
    }


    //$rootScope.selectedLanguage = 'es';
    $rootScope.changeLanguage = function() {
      console.log("changing language to " + $rootScope.selectedLanguage);
      localStorage.setItem("lang", $rootScope.selectedLanguage);
      $translate.use($rootScope.selectedLanguage);
      $http.get('changelang/' + $rootScope.selectedLanguage)
        .then(
          function(response) {
            console.log("response");
            console.log(response);
            if (response.statusText == 'OK') {
              console.log("language changed");
            } else {
              Materialize.toast('Intenta nuevamente mas tarde.', 5000);
            }
          },
          function(response) {
            Materialize.toast('Intenta nuevamente mas tarde.', 5000);
          });

      return;
    }

    $timeout(
      function() {
        $rootScope.moveMapTo = {
          latitude: -12.382928338487396,
          longitude: -79.27734375,
          zoom: 3
        };
      }, 500);
    $rootScope.places = [];
    $rootScope.navigating = false;
    $scope.currentMarker = undefined;

    $rootScope.main = true;
    $rootScope.navBar = ""
    $scope.collapsibleElements = copyService.getAll();
    //console.log($scope.collapsibleElements);
  });
