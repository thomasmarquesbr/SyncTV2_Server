var app = angular.module('SyncTV', ['ui.bootstrap']);

//-----------------------------------Index.php-----------------------------------

app.controller('LoginController', function($scope, $modal){
  

  $scope.cadastrar = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/cadastrarModal.html',
      controller: 'LoginModalController'
    }); 
  };

});

app.controller('LoginModalController', function($scope, $modalInstance){

  $scope.errorMessage = '';

  $scope.enviar = function(){
    //alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  
});

//-----------------------------------main.php-----------------------------------

app.controller('MainController', function($scope){
  
  $scope.sair = function(){
    alert('enviar');
  };

});


app.controller('PerfilController', function($scope){
  $scope.alterPwd = function(){
    alert('alterar password');
  };
});


//-----------------------------------geral.php-----------------------------------

app.controller('geralController', function ($scope,$http) {
  $scope.oneAtATime = true;

  $scope.groups = [
    {
      title: 'Dynamic Group Header - 1',
      content: 'Dynamic Group Body - 1'
    },
    {
      title: 'Dynamic Group Header - 2',
      content: 'Dynamic Group Body - 2'
    }
  ];

  $scope.getJson = function(){
    $http.get("http://localhost/synctv2.0/example.json")
      .success( function (response) {$scope.items = response;} );
  };
  $scope.getJson();

});


//---------------------------------channels.php---------------------------------

app.controller('channelsController', function($scope, $modal, $http){
  
  $scope.newChannel = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/newChannelModal.html',
      controller: 'newChannelModalController',
      backdrop: 'static'
    }); 
  };

  $scope.getJson = function(){
    $http.get("http://localhost/synctv2.0/example.json")
      .success( function (response) {$scope.names = response;} );
  };
  $scope.getJson();

});

app.controller('newChannelModalController', function($scope, $modalInstance){

  $scope.errorMessage = '';

  $scope.salvar = function(){
    alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  
});

//---------------------------------Schedules.php---------------------------------

app.controller('schedulesController', function($scope, $modal, $http){
  
  $scope.newSchedule = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/newScheduleModal.html',
      controller: 'newScheduleModalController',
      backdrop: 'static'
    }); 
  };

  $scope.getJson = function(){
    $http.get("http://localhost/synctv2.0/example.json")
      .success( function (response) {$scope.names = response;} );
  };
  //$scope.getJson();

});

app.controller('newScheduleModalController', function($scope, $modalInstance){

  $scope.errorMessage1 = '';
  $scope.errorMessage2 = '';


  $scope.calendar = { opened: false};
  $scope.calendar = { opened: false};
  $scope.salvar = function(){
    alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  

  //----DatePicker---

  $scope.today = function() {
    $scope.dtBegin = new Date();
    $scope.dtEnd = new Date();
  };
  $scope.today();

  $scope.$watch('dtBegin', function(newVal, oldVal){
    //alert('watch');
    if($scope.dtEnd < newVal){
      $scope.dtEnd = newVal;
    }
  });

  $scope.toggleMin = function() {
    $scope.minDateBegin = new Date();
  };
  $scope.toggleMin();


  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.calendar.opened = true;
  };

  $scope.open2 = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.calendar.opened2 = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  //$scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.formats = ['dd-MMMM-yyyy'];
  $scope.format = $scope.formats[0];

  $scope.step = 1;
  $scope.setStep = function(step){
         $scope.step = step;
        }


  //------TimePicker-----

});
