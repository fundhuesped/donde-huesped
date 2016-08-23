'use strict';

/* Filters */
dondev2App.factory('placesFactory', function($http, $filter) {

	var factory = {
		countries:[],
		provinces:[],
		cities:[],
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
		getCountries:function(cb){
			$http.get('api/v1/countries/all')
				.success(function(countries){
					factory.countries = countries;
					cb(countries);
			});
		},
		load: function(cb){


			$http.get('api/v1/places/all')
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
					 for (var i = 0; i < factory.provinces.length; i++) {
					 	var p = factory.provinces[i];
					 	if (p !== ""){
						 	var s = {
		                                	pais: p.pais,
		                                	provincia_region: p.provincia_region
		                                };
						 	factory.getAllFor(s,function(data){
						 		factory.provinces[i].geo = {
						 			latitude: data[0].latitude,
						 			longitude: data[0].longitude,
						 			zoom:8,
						 		};
						 	});
						 }
					 	
					 };

	                   cb();
			});

		},
		getProvincesForCountry:function(p,cb){
			$http.get('api/v1/countries/'+ p +'/provinces')
				.success(function(provinces){
					factory.provinces[p] = provinces;
					cb(provinces);
			});
			
		},
		getAllFor:function(s,cb){
			$http.get('api/v1/places/'+ s.pais +'/'+  s.provincia +'/'+ s.partido)
				.success(function(places){
					cb(places);
			});
		},
		getCitiesForProvince: function(p,cb){
			$http.get('api/v1/provinces/'+ p.id +'/cities')
				.success(function(cities){
					factory.cities[p] = cities;
					cb(cities);
			});
			
		
		}
	}
  	

	return factory;
});
	