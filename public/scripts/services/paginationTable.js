dondev2App.factory('paginationTable', function($http, $filter) {
	var factory = {
		startPagination: function(data, limit){
			if(data === undefined) return [];
			var currentPage = 0;
			var pageSize = limit;
			totalPages = Math.ceil(data.length/pageSize);
			arr = {currentPage: currentPage, pageSize: pageSize, totalPages: totalPages};
			return arr;
		},
		getFilter: function(newFilter,scopeFilter){
			if (newFilter == "" && scopeFilter != ""){		// newFilter nulo: devuelve el actual
				return scopeFilter;
			}
			if (scopeFilter.indexOf(newFilter) > -1){ 		// filter: + ascendente, - descendente
				if (scopeFilter.indexOf('-') > -1){			// invertir el filtro
					scopeFilter = newFilter;				// era descendente (-), ahora ascendente (+)
				}
				else{
					scopeFilter = '-' + newFilter;			// era ascendente, ahora descendente
				}
			}
			else{
				scopeFilter = newFilter;					// Filtro anterior diferente, comienza por ascendente
			}
			return scopeFilter;
		},
		sortData: function(arr,scopeFilter){
			if(!arr || arr === undefined || arr.length == 0) return;
			arr.sort(function(a, b) {
				var filter = scopeFilter;
				var reverse = 1;
				if (filter.indexOf('-') > -1){
					reverse = -1;
					filter = filter.slice(1);
				}
				var valueA = a[filter], valueB = b[filter];
				if (valueA < valueB) return -1 * reverse;
				if (valueA > valueB) return 1 * reverse;
				return 0;
			});
		}
	}
	return factory;
});