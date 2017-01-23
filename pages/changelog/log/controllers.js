angular.module('Changelog',[]) 
    .config(function ($httpProvider) {        
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }).factory('featuresData', function ($http) {
        return{          
            doCrossDomainGet: function() {
                return $http({
                    url:'https://spreadsheets.google.com/feeds',
                    method: 'GET'
                })
            }        
        }
});


function ChangelogController($scope, $http){
	
	// URL of the Google Spreadsheet
	$scope.url = "https://spreadsheets.google.com/feeds/list/0AkGk3GyWwWwcdGkyeVU5VzdrNzhnNTN3RXZzSzN1Ync/od6/public/values?alt=json";

	// Function to get the data out of spreadsheet
	// we create a "entries" object on scope
	var getEntryData = function() {

		// HTTP request to get the data from our spreadsheet
		$http({method: 'GET', dataType: 'json', url: $scope.url}).
  		success(function(data, status, headers, config, response) {
    		console.log(data);
    		// Create our "posts" object on the scope 
    		// with the data from the http request (sepecically, the entries array)
    		$scope.entries = data.feed.entry;
    		
  		}).
  		error(function(data, status, headers, config) {
   	 		conole.log("Error getting data from spreadsheet, with error: "+status);
  		});
  	}

  	// Get the data
  	getEntryData();
}