'use strict';

/* Filters */
dondev2App.factory('placesFactory', function($http, $filter) {

	var factory = {
		getAll: function(callback){
			var places =[];
			callback(places);
		}
	}
  	

	return factory;
});
	