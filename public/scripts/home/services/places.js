'use strict';

/* Filters */
dondev2App.factory('placesFactory', function($http, $filter) {

	var factory = {
		getAll: function(cb){
			var places =[];
			cb(places);
		}, 
		forLocation: function(l,cb){

	  		var onDb = function(){
	  			var places = factory.db;
	  			var lat = l.latitude;
	        	var lon = l.longitude;
	        	var mock = {latitude:0, longitude:0};
	  			
	  			places.sort(function(a,b){

	  				var geoA = a.latitude ? a : mock;
	  				var geoB = b.longitude ? b : mock;


	  				var distanceFromA = Math.abs(getDistanceFromLatLonInKm(geoA.latitude,geoA.longitude,lat,lon));
	  				var distanceFromB = Math.abs(getDistanceFromLatLonInKm(geoB.latitude,geoB.longitude,lat,lon));
	  				a.distance = Math.round(distanceFromA * 10);
	  				b.distance = Math.round(distanceFromB * 10);
	  				 if (distanceFromA> distanceFromB) {
					    return 1;
					  }
					  if (distanceFromA < distanceFromB) {
					    return -1;
					  }
					  // a must be equal to b
					  return 0;
	  			});
	  			// Se obtienen las 20 mas cercanas
				// Luego el promedio de distancia.  
				// Saco el promedio de los 3 primeros
				var closest = places.slice(0,20);
				var totalDistance = 0 ;
				var sampleSize = 3;
				for (var i = 0; i < sampleSize; i++) {
					var distance = closest[i].distance;
					totalDistance+= distance;
				};
				var averageDistance = totalDistance/sampleSize;

				
				var finalClosest = [];

				for (var i = 0; i < closest.length; i++) {
					var c = closest[i];
					//Si esta por debajo, entra.
					if (distance <= averageDistance){
						finalClosest.push(c);
					}
					// Si esta por arriba del 350%, se sacan
					else {
						var percentage = c.distance * 100/averageDistance;
						if (percentage < 350){
							finalClosest.push(c);
						}

					}
					
				};

	  			cb(finalClosest);

	  	
  			};
	  		if (!factory.db){
				factory.load(onDb);
				
			}
			else {
				onDb();
			}
		},
		load: function(cb){
			$http.get('/datasets/full.min.json')
				.success(function(places){
					factory.db = places;
					var expression = 'provincia_region';
					//by country

					factory.provinces =
	                $filter('unique')(places, expression, false)
	                        .map(function(d){
	                            if (d.provincia_region &&
	                                d.provincia_region !== ""){
	                                return {
	                                	pais: d.pais,
	                                	provincia_region: toTitleCase(d.provincia_region)
	                                };
	                            }
	                            else {
	                                return "";
	                            }
	                        });
					    

	                   cb();
			});

		},
		getProvincesForCountry:function(p,cb){
			var onDb = function(){
				var expression = {
					pais: p
				}
	  			var result = $filter('filter')(factory.provinces,expression,false);
	  			result = $filter('orderBy')(result, "+provincia_region");
	  			cb(result);
			}
			if (!factory.db){
				factory.load(onDb);
				
			}
			else {
				onDb();
			}
		},
		getAllFor:function(s,cb){
			var onDb = function(){
				var expression = s
	  			var result = $filter('filter')(factory.db,expression,false);
	  			expression = 'establecimiento';
	  			result = $filter('orderBy')(result, "+nombre");
	  			cb(result);
			}
			if (!factory.db){
				factory.load(onDb);
				
			}
			else {
				onDb();
			}
		},
		getCitiesForProvince: function(p,cb){
			var onDb = function(){
	  			var expression = {provincia_region:p.provincia_region, pais: p.pais};
	  			var result = $filter('filter')(factory.db,expression,false);
	  			expression = 'partido_comuna';
	  			result = $filter('unique')(result,expression,false);
	  			result = $filter('orderBy')(result, "+partido_comuna");
	  			result = result.map(function(d){ return d.partido_comuna });
	  			cb(result);
	  		}
	  		if (!factory.db){
				factory.load(onDb);
			}
			else {
				onDb();
			}
		}
	}
  	

	return factory;
});
	