    // create the module and name it spaApp
    // also include ngRoute for all our routing needs //,'ngTouch','ngAnimate','ui.bootstrap'
   var spaApp = angular.module('spaApp', ['ngRoute','ngTouch','ngAnimate','ui.bootstrap']);

    // configure our routes
    spaApp.config(function($routeProvider) {
              $routeProvider
              // route for the home page
              .when('/', {
                  templateUrl : 'home.html',
                  controller  : 'mainController'
              })
			  .when('/about', {
                  templateUrl : 'about.html',
                  controller  : 'aboutController'
              })
			   .when('/contact', {
                  templateUrl : 'contact.html',
                  controller  : 'contactController'
              })
    });



// create the controller and inject Angular's $scope
spaApp.controller('mainController', function($scope,$http,$routeParams,$uibModal){
	         
		$scope.showPopup = function(){	
					
		  user = {'first_name':'JON','last_name':'Smith','address':'Ny'};
		  $scope.modalInstance = $uibModal.open({
				 ariaLabelledBy: 'modal-title',
				 ariaDescribedBy: 'modal-body',
				 templateUrl: 'view.html',
				 controller :'ModelHandlerController',
				 controllerAs: '$ctrl',
				 size: 'lg',
				 resolve: {
					  user: function(){
							return user;
						 }
					}
			   });
			   
		}
						
	    
	});
	
spaApp.controller("ModelHandlerController",function($scope,$uibModalInstance,$http){
  
		
		$scope.first_name = user.first_name;
		$scope.last_name = user.last_name;
		$scope.address  = user.address;
		
		 $scope.cancelModal = function(){
			 console.log("cancelmodal");
			 $uibModalInstance.dismiss('close');
		 }
		 $scope.ok = function(){
		 $uibModalInstance.close('save');
		 
		 }
		
 
});	
	
	
// create the controller and inject Angular's $scope
spaApp.controller('aboutController', function($scope,$routeParams){
	    $scope.first_name = "Jon";
		$scope.last_name = "Smith";
		$scope.changeName = function(){
			$scope.first_name = "New Jon";
		    $scope.last_name = "Mew Smith";
		}
	});
spaApp.controller('contactController', function($scope,$routeParams){
	    
	});	
	
	

