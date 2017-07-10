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

	  		$http.get('api/v1/places/geo/' + l.latitude + '/' + l.longitude)
				.success(function(cercanos){
					cb(cercanos);
			});
		},
		getCountries:function(cb){
			$http.get('api/v1/countries/all')
				.success(function(countries){
					factory.countries = countries;
					cb(countries);
			});
		},
		load: function(cb){

			cb();

		},
		getProvincesForCountry:function(p,cb){
			$http.get('api/v1/countries/'+ p +'/provinces')
				.success(function(provinces){
					factory.provinces[p] = provinces;
					cb(provinces);
			});

		},
		getAllFor:function(s,cb){
			$http.get('api/v1/places/'+ s.pais +'/'+  s.provincia +'/'+ s.partido + '/' + s.service)
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
	
