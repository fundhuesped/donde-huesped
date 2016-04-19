
dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})
.filter('removeAccents',function() {

  // Create the return function
  // set the required parameter name to **number**
  return function(text) {
    return removeAccents(text);
  } 
})
.filter('matchCity',function() {

  // Create the return function
  // set the required parameter name to **number**
  return function(text) {

    return removeAccents(text);
  } 
})

.controller('panelIndexController', function(NgMap,
  placesFactory,$filter, $scope,     $timeout, $rootScope, $http, $interpolate, $location, $route) {

    
    

    var filterAccents = function(place){
      place.establecimiento = removeAccents(place.establecimiento);
      place.nombre_provincia = removeAccents(place.nombre_provincia);
      place.nombre_localidad = removeAccents(place.nombre_partido);
      place.calle = removeAccents(place.calle);
      return place;
    }
    $scope.filterLocalidad = "";
    $scope.searchExistence = "";
     $scope.data = {
      selectedIndex: 0,
      secondplaceed:  true,
      secondLabel:   "Item Two",
      bottom:        false
    };
    $scope.next = function() {
      $scope.data.selectedIndex = Math.min($scope.data.selectedIndex + 1, 2) ;
    };
    $scope.previous = function() {
      $scope.data.selectedIndex = Math.max($scope.data.selectedIndex - 1, 0);
    };

    $scope.loadingPrev = true;
    $scope.loadingPost = true;
    $scope.loadingDep = true;
    $scope.getFontSize = function(c){

      var size = 1;



      return {"font-size": size + "em"};
    }
    $rootScope.showInfo = $scope.showInfo = function(e,i){
      window.open("/panel/places/" + i.placeId);


      
    }
  
  


  $rootScope.getNow = function(){
   $rootScope.loadingPost = true;
      $http.get('api/v1/panel/places/approved/' +   $rootScope.selectedCountry.id  + '/' +  $rootScope.selectedProvince.id + '/' + +   $rootScope.selectedCity.id )
              .success(function(response) {

                  for (var i = 0; i < response.length; i++) {
                    response[i] = filterAccents(response[i]);

                  };
                  $rootScope.filteredplaces = $scope.filteredplaces = $scope.places = $rootScope.places = response;
                  
                  $rootScope.loadingPost = false;
                  //TODO: Move to service
                  var count = _.countBy(response, function(l){
                    return l.nombre_partido + ", " + l.nombre_provincia } );
                  var mapped = _.map(count,function(n,k){return {
                    key: k,count:n, percentage:n*100/response.length};});
                  var ordered = _.sortBy(mapped,"count").reverse();
                  ordered = _.map(ordered,function(n,i){
                    n.position = i+1;
                    return n;
                  });

                  $rootScope.cityRanking = ordered;
                  NgMap.initMap('mapEditor');
                  $rootScope.filterAllplaces();

          });
  }

   $rootScope.loadCity = function(){
    $rootScope.showCity = true;
    placesFactory.getCitiesForProvince( $rootScope.selectedProvince,function(data){
       $rootScope.cities = data;
    })

  };
  $scope.showSearch = function(){
    $scope.searchOn= true;
  }

  $rootScope.showProvince = function(){
    
    $rootScope.provinceOn= true;
    placesFactory.getProvincesForCountry( $rootScope.selectedCountry.id,function(data){
       $rootScope.provinces = data;
    });
    
  }
    var loadAllLists = function(){
          $scope.loadingPrev = true;
          $scope.loadingPost = false;
          $scope.loadingDep = true;

          $scope.loadingDashboard = true;

           $http.get('api/v1/panel/places/ranking')
              .success(function(data) {
                  for (var i = 0; i < data.length; i++) {
                    var d= data[i];
                    data[i].key = d.nombre_partido + " " + d.nombre_provincia + " , " + d.nombre_pais 
                  };
                  $scope.ranking = data;
                  $scope.loadingDashboard = false;
              });

          $http.get('api/v1/panel/places/badGeo')
              .success(function(data) {
                  for (var i = 0; i < data.length; i++) {
                    var d= data[i];
                    data[i].key = d.nombre_partido + " " + d.nombre_provincia + " , " + d.nombre_pais 
                  };
                  $scope.badGeo = data;
                  $scope.loadingDashboard = false;
              });

          $http.get('api/v1/panel/places/nonGeo')
              .success(function(data) {
                  for (var i = 0; i < data.length; i++) {
                    var d= data[i];
                    data[i].key = d.nombre_partido + " " + d.nombre_provincia + " , " + d.nombre_pais 
                  };
                  $scope.nonGeo = data;
                  $scope.loadingDashboard = false;
              });
         

          $http.get('api/v1/panel/places/pending')
              .success(function(response) {
                for (var i = 0; i < response.length; i++) {
                   response[i] =  filterAccents(response[i]);

                  };
                  $scope.penplaces = response;
                  $scope.loadingPrev = false;
              });


            $http.get('api/v1/panel/places/blocked')
              .success(function(response) {
                for (var i = 0; i < response.length; i++) {
                    response[i] = filterAccents(response[i]);

                  };
                  $scope.rejectedplaces = response;

                  $scope.loadingDep = false;
            });
    };

    loadAllLists();
    $rootScope.onlyBadGeo = true;
    $rootScope.onlyGoodGeo = true;
    $scope.filterAllPlaces = $rootScope.filterAllplaces = function(q){

        var result = [];
         var filterPlaces = [];
        var filterValues = {
            $:""
        };
        if ($rootScope.searchExistence.length > 3){
          filterValues = {
            $:$rootScope.searchExistence
          };
        }

        var preFilter = 
          $filter('filter')($rootScope.places,filterValues);
     
        for (var i = 0; i < preFilter.length; i++) {
          var p = preFilter[i];
          if (!p.confidence && $rootScope.onlyBadGeo){
            result.push(p);

          }
          else if (p.confidence ===0.5 && $rootScope.onlyBadGeo){
            result.push(p);
          }
          else if (p.confidence > 0.5 && $rootScope.onlyGoodGeo){
            result.push(p);
          }
        }
         $rootScope.filteredplaces = $scope.filteredplaces = result;

      
    }


    $scope.blockNow= function(place){
      console.log(place);
       $('#demoModal').openModal();
       $scope.current = place;
    };

    $scope.removePlace = function(){

    $http.post('api/v1/panel/places/' + $scope.current.placeId + '/block')
      .then(
        function(response) {
          if (response.data.length == 0) {
            Materialize.toast('La peticion de ' + $scope.current.establecimiento + ' ha sido rechazada.', 5000);
          } else {
            for (var propertyName in response.data) {
              Materialize.toast(response.data[propertyName], 10000);
            };
          }

        },
        function(response) {
          Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);

        });

       Materialize.toast($scope.current.establecimiento + " ha sido rechazada.",4000);
       $('#demoModal').closeModal();
       $scope.current = {};
       loadAllLists();
    };
    $scope.closeModal= function(place){
       $('#demoModal').closeModal();
       $scope.current = {};
    };

 
    placesFactory.getCountries(function(countries){
        $rootScope.countries = countries;
      });    



  






});
