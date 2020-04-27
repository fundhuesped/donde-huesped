dondev2App.controller('mapController',
	function(placesFactory,NgMap, $scope,$rootScope, $timeout, $routeParams, $location, $http){

    //Constants
    var overviewZoom = 5;
    var placeZoom = 16;
    var initLocation = {latitude: -27.433133, longitude: -63.046042};

    //Private variables
    var markers = [];
    $scope.bounds = [];

    //Shared variables
    $rootScope.moveMapTo;

    // Init map when ready
    function initMap() {
      $rootScope.centerMarkers = [];
      $rootScope.moveMapTo = initLocation;
      changeZoom("overview");
      $scope.bounds = new google.maps.LatLngBounds();
    }

    // Watch out when the map needs to be moved
    $rootScope.$watch('moveMapTo', function(coords){
      if(coords && coords.latitude && coords.longitude){
        var pos = new google.maps.LatLng(coords.latitude, coords.longitude);
        if (window.map){
          window.map.setCenter(pos);
          window.map.panTo(pos);
        }
      }
    });

    // Changes zoom of map. "location" is for auto-zoom, "overview" is for init zoom, "place" for a selected place
    function changeZoom(zoom){
      if (window.map){
        switch (zoom) {
          case "overview":
          window.map.setZoom(overviewZoom); break;
          case "location":
          //auto-zoom
          window.map.fitBounds($scope.bounds);
          window.map.panToBounds($scope.bounds);
          break;
          case "place":
          window.map.setZoom(placeZoom); break;
          default:
          window.map.setZoom(overviewZoom); break;
        }
      }
    };

    //Watch places. If changed, reset markers. Prefilter centers to avoid doubled markers on same geolocation
    $rootScope.$watch('places', function(){
      var places = clone($rootScope.places);
      var centers = $rootScope.centerMarkers;
      if(places && places.length !== 0){
        deleteMarkers();
        places = filterPlacesOverCenters(places,centers);
        for (var i = 0; i < places.length; i++) {
          var item = places[i];
          pushMarkerPlace(item);
        }
        if(centers && centers.length !== 0){
          for (var i = 0; i < centers.length; i++) {
            var item = centers[i];
            pushMarkerCenter(item);
          }
        }
        //Call auto-zoom after placing markers
        changeZoom("location");
      }
    });

    // Watch out changes on currentMarker. Must delete a present place marker before
    $rootScope.$watch('currentMarker', function(item){
      var centers = $rootScope.centerMarkers;
      if(centers && centers.length !== 0){
        for (var i = 0; i < centers.length; i++) {
          var item = centers[i];
          deleteMarkerByID(item.placeId);
          pushMarkerCenter(item);
        }
      }
      // If currentMarker has changed, it means that a place has been selected
      if(item){
        $rootScope.moveMapTo = {latitude: item.latitude, longitude: item.longitude};
        changeZoom("place");
      }
    });

    function clone(obj){
      if (null == obj || "object" != typeof obj) return obj;
      var copy = obj.constructor();
      for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
      }
      return copy;
    }

    // Delete marker by ID
    function deleteMarkerByID(id){
      for (var i = 0; i < markers.length; i++) {
        if(markers[i]['ID'] == id){
          markers[i]['marker'].setMap(null);
          markers.splice(i,1);
          return i;
        }
      }
      return -1;
    }

    // Get rid of centers that are present on places, avoiding double markers
    function filterPlacesOverCenters(places, centers){
      if(centers && centers.length !== 0){
        for (var j = 0; j < centers.length; j++) {
          for (var i = 0; i < places.length; i++) {
            if(centers[j].placeId == places[i].placeId){
              places.splice(i, 1);
            }
          }
        }
      }
      return places;
    }

    // Set markers on screen (or not)
    function setMapOnMarkers(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i]['marker'].setMap(map);
      }
    }

    // Refresh markers
    function deleteMarkers() {
      setMapOnMarkers(null);
      markers = [];
    }

    function pushMarkerPlace(item){
      pushMarker(item,false);
    }

    function pushMarkerCenter(item){
      pushMarker(item,true);
    }

    function pushMarker(item,is_selected = false){
      // creates marker (check if it's selected or not)
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(item.latitude,item.longitude),
        icon: (is_selected)?"images/place-on.png":"images/place-off.png"
      });
      // add to local list
      markers.push({
        'marker': marker,
        'ID': item.placeId
      });
      // add 'click' listener
      markers[markers.length - 1]['marker'].addListener('click', showCurrent.bind(this, item));
      // add to map
      markers[markers.length - 1]['marker'].setMap(window.map);
      // add bounds for auto-zoom
      loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
      $scope.bounds.extend(loc);
    }

    // Wait for client
    $scope.$watch('$viewContentLoaded', function() { 
      $timeout(function() {
        initMap();
      },1000);    
    });

    // Bind 'click' function on map
    function showCurrent (place){
      $rootScope.navBar = place.establecimiento;

      // Load comments
      var urlComments = "api/v2/evaluacion/comentarios/" + place.placeId;
      place.comments = [];
      $http.get(urlComments)
      .then(function(response) {
        place.comments = response.data;
        place.comments.forEach(function(comment) {
          comment.que_busca = comment.que_busca.split(',');
        });
      });

      // Actualizar el marker seleccionado. Actualiza el mapa automaticamente
      $rootScope.currentMarker = place;
      $rootScope.centerMarkers.push($rootScope.currentMarker);

      var path = $location.path();
      if (path.indexOf('listado') > -1){
        var newPath = path.replace('listado','mapa');
        $location.path(newPath);
      }
    }

  });
