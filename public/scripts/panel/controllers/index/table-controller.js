dondev2App.filter('startFrom', function() {
  return function(input, start, scope) {
    start = +start; //parse to int
    if(input !== undefined){
      return input.slice(start);
    }
    return input;
  }
});

dondev2App.controller('tableController', function(placesFactory, $scope, $rootScope, $http, $filter, paginationTable){

  $scope.loadingPrev = true;
  $scope.dataTable = [];
  $scope.type = '';
  $scope.filter = '';
  $scope.currentPage = 0;
  $scope.pageSize = 0;
  $scope.totalPages = 0;

  $scope.init = function(type, filter){
    $scope.type = type;
    $scope.filter = filter;
    switch($scope.type){
      case 'pending':
      placesFactory.getPendingPlaces((response) => loadData(response));
      break;
      case 'rejected':
      placesFactory.getBlockedPlaces((response) => loadData(response));
      break;
      case 'imports':
      placesFactory.getImportTags((response) => loadData(response));
      break;
      case 'evaluations':
      placesFactory.getTotalEvals((response) => loadData(response));
      break;
    }
  }

  function loadData(response){
    for (var i = 0; i < response.length; i++) {
      response[i] = filterAccents(response[i]);
    };
    assignToRootScope(response);
    $scope.loadingPrev = false;
  }

  function assignToRootScope(response){
    switch($scope.type){
      case 'pending':
      $rootScope.penplaces = response;
      break;
      case 'rejected':
      $rootScope.rejectedplaces = response;
      break;
      case 'imports':
      $rootScope.tagsImportaciones = response;
      break;
      case 'evaluations':
      $rootScope.evaluations = response;
      $rootScope.totalEvals = response.length;
      break;
    }
  }

  $rootScope.$watch('rejectedplaces', function(data){
    if($scope.type !== 'rejected') return;
    $scope.filteredDataTable = $rootScope.rejectedplaces;
    setUpData();
  })

  $rootScope.$watch('tagsImportaciones', function(data){
    if($scope.type !== 'imports') return;
    $scope.filteredDataTable = $rootScope.tagsImportaciones;
    setUpData();
  })

  $rootScope.$watch('evaluations', function(data){
    if($scope.type !== 'evaluations') return;
    $scope.filteredDataTable = $rootScope.evaluations;
    setUpData();
  })

  $rootScope.$watch('penplaces', function(data){
    if($scope.type !== 'pending') return;
    $scope.filteredDataTable = $rootScope.penplaces;
    setUpData();
  })

  $rootScope.$watch('places', function(data){
    if($scope.type !== 'active') return;
    $scope.filteredDataTable = $rootScope.places;
    setUpData();
  })

  function setUpData(){
    if($scope.filteredDataTable !== undefined){
      $scope.dataTable = $scope.filteredDataTable;
      $scope.orderDataTable();
      applyData($scope.filteredDataTable);
    }
  }

  $scope.searchValue = function(){
    $scope.filteredDataTable = $filter('filter')($scope.dataTable,$scope.search);
    applyData($scope.filteredDataTable);
  }

  function filterAccents(place){
    place.establecimiento = removeAccents(place.establecimiento);
    place.nombre_provincia = removeAccents(place.nombre_provincia);
    place.nombre_localidad = removeAccents(place.nombre_partido);
    place.calle = removeAccents(place.calle);
    return place;
  }

  function assignResults(arr){
    $scope.currentPage = arr.currentPage;
    $scope.pageSize = arr.pageSize;
    $scope.totalPages = arr.totalPages;
  }

  function applyData(data){
    var arr = paginationTable.startPagination(data);
    if(arr === []) return;
    assignResults(arr);
  }

  $scope.previous = function(){
    if($scope.currentPage !== 0)
      $scope.currentPage = $scope.currentPage - 1;
  }

  $scope.next = function(){
    if($scope.currentPage <= $scope.filteredDataTable.length/$scope.pageSize - 1)
      $scope.currentPage = $scope.currentPage + 1;
  }

  $scope.orderDataTable = function(newFilter = ""){
    var filter = paginationTable.getFilter(newFilter,$scope.filter);
    $scope.filter = filter;
    paginationTable.sortData($scope.filteredDataTable,$scope.filter);
  }

});