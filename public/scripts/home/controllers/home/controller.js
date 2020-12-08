dondev2App.controller('homeController',
  function($timeout, copyService, placesFactory, NgMap, $anchorScroll, $scope, $rootScope, $routeParams, $location, $http, $translate, $cookies) {

  window.onload = function() {
    $rootScope.changeLanguage();
  };

  // var userLang = navigator.language || navigator.userLanguage;
  var userLang = 'es';
  if (typeof localStorage.selectedByUser === "undefined" || typeof localStorage.lang === "undefined") {
    localStorage.setItem("lang", userLang);
    localStorage.setItem("selectedByUser", false);
    $translate.use(userLang);
  }

    var lang = localStorage.getItem("lang");
    $rootScope.selectedLanguage = lang;

    $rootScope.selectedLanguageFunc = function(lang) {

      if ($rootScope.selectedLanguage == lang) {

        $('language1').material_select();
        return true;
      } else {

        return false;
      }
    }

    $rootScope.changeLanguage = function() {

      localStorage.setItem("lang", $rootScope.selectedLanguage);
      localStorage.setItem("selectedByUser", true);
      $translate.use($rootScope.selectedLanguage);
      $cookies.put('lang' , $rootScope.selectedLanguage);
      $http.get('changelang/' + $rootScope.selectedLanguage)
      .then(
        function(response) {

          if (response.data.status == 'ok') {

          } else {
            Materialize.toast('Intenta nuevamente mas tarde.', 5000);
          }
        },
        function(response) {
          Materialize.toast('Intenta nuevamente mas tarde.', 5000);
        });

      return;
    }

    $rootScope.places = [];
    $rootScope.navigating = false;
    $scope.currentMarker = undefined;

    $rootScope.main = true;
    $rootScope.navBar = ""
    $scope.collapsibleElements = copyService.getAll();

  });
