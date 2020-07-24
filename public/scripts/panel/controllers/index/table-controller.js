// startFrom filter: cut an array from the begin index required
// limitTo filter: cut an array to the end index required
// startFrom filter should be executed before limitTo filter on data table
dondev2App.filter('startFrom', function() {
  return function(input, start, scope) {
    start = +start; //parse to int
    if(input !== undefined){
      return input.slice(start);
    }
    return input;
  }
});

// Controller for data table
dondev2App.controller('tableController', function(placesFactory, $scope, $rootScope, $http, $filter, paginationTable){

  $scope.loadingPrev = true;
  $scope.dataTable = [];
  $scope.type = '';
  $scope.filter = '';
  $scope.pageSize = 100;
  $scope.currentPage = 0;
  $scope.totalPages = 0;

  // Init of controller by call from view
  $scope.init = function(type, filter){
    $scope.type = type;       //the name of rootScope's var
    $scope.filter = filter;   //the initial filter to order data table
    placesFactory.getDataTable(type,(response) => loadData(response));
    $scope.loadingPrev = false;
  }

  // Store data acquired from services
  function loadData(response){
    for (var i = 0; i < response.length; i++) {
      response[i] = filterAccents(response[i]);
    };
    $rootScope[$scope.type] = response;
  }

  function filterAccents(place){
    place.establecimiento = removeAccents(place.establecimiento);
    place.nombre_provincia = removeAccents(place.nombre_provincia);
    place.nombre_localidad = removeAccents(place.nombre_partido);
    place.calle = removeAccents(place.calle);
    return place;
  }

  // Every change to rootScope var should fire data table set up
  $rootScope.$watch(
    function(){
      return $rootScope[$scope.type];
    },
    function(data){
      if(data === undefined) return;
      setUpDataTable($rootScope[$scope.type]);
    })

  // Update main data of table. Order new data by current filter. Set up pagination config
  function setUpDataTable(data){
    if(data === undefined) return;
    $scope.dataTable = data;          //main data of table
    $scope.filteredDataTable = data;  //current data to display (in currentPage)
    $scope.orderDataTable();
    setUpPagination($scope.filteredDataTable);
  }

  function setUpPagination(data){
    var arr = paginationTable.startPagination(data,$scope.pageSize);
    assignToScope(arr);
  }

  function assignToScope(arr){
    if(arr === []) return;
    $scope.pageSize = arr.pageSize;
    $scope.currentPage = arr.currentPage;
    $scope.totalPages = arr.totalPages;
  }

  $scope.previous = function(){
    if($scope.currentPage !== 0)
      $scope.currentPage = $scope.currentPage - 1;
  }

  $scope.next = function(){
    if($scope.currentPage <= $scope.filteredDataTable.length/$scope.pageSize - 1)
      $scope.currentPage = $scope.currentPage + 1;
  }

  // Search callback for input to filter data
  $scope.searchValue = function(){
    $scope.filteredDataTable = $filter('filter')($scope.dataTable,$scope.search);
    setUpPagination($scope.filteredDataTable);
  }

  // If newFilter is empty, should reorder data with current filter.
  $scope.orderDataTable = function(newFilter = ""){
    $scope.filter = paginationTable.getFilter(newFilter,$scope.filter);
    paginationTable.sortData($scope.filteredDataTable,$scope.filter);
  }

});