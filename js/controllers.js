var app = angular.module('SyncTV', ['ui.bootstrap','angularFileUpload']);

//-----------------------------------Index.php-----------------------------------

app.controller('LoginController', function($scope, $modal){
  

  $scope.cadastrar = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/cadastrarModal.html',
      controller: 'LoginModalController',
      backdrop: 'static',
      keyboard: false
    }); 
  };

});

app.controller('LoginModalController', function($scope, $modalInstance){

  //$scope.errorMessage = '';

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

app.controller('geralController', function ($scope, $http) {
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
    $http.get("http://localhost:8888/synctv2/example.json")
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
      backdrop: 'static',
      keyboard: false
    }); 
  };

  $scope.editChannel = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/editChannelModal.html',
      controller: 'editChannelModalController',
      backdrop: 'static',
      keyboard: false
    });
  };

});

//---------New Channel-----------------
app.controller('newChannelModalController', function($scope, $modalInstance){

  $scope.errorMessage = '';


  $scope.save = function(){
    alert('Salvando ' + $scope.channel.name + $scope.channel.description);
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  
});

//---------Edit Channel------------------
app.controller('editChannelModalController', function($scope, $modalInstance){

  $scope.errorMessage = '';


  $scope.save = function(){
    alert('Editando');
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
      backdrop: 'static',
      keyboard: false
    }); 
  };

  $scope.editSchedule = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/editScheduleModal.html',
      controller: 'editScheduleModalController',
      backdrop: 'static',
      keyboard: false,
      size: 'lg'
    });
  };

  $scope.getJson = function(){
    $http.get("http://localhost:8888/synctv2/example.json")
      .success( function (response) {$scope.names = response;} );
  };
  //$scope.getJson();

});

//------------New Schedule---------------

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

//------------Edit Schedule---------------

app.controller('editScheduleModalController', function($scope, $modalInstance){

  $scope.save = function(){
    alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };

});

//----------------------------------Multimidia.php--------------------------------
app.controller('multimidiaController', function($scope, $modal, $http){
  
  $scope.newMedias = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/newMediasModal.html',
      controller: 'newMediasController',
      backdrop: 'static',
      keyboard: false,
      size: 'lg'
    }); 
  };

  $scope.editMedias = function(){
    var modalInstanceInstance = $modal.open({
      templateUrl: 'templates/editMediasModal.html',
      controller: 'editMediasController',
      backdrop: 'size',
      keyboard: false,
      size: 'lg'
    });
  };

  $scope.getJson = function(){
    $http.get("http://localhost:8888/synctv2/example.json")
      .success( function (response) {$scope.names = response;} );
  };
  //$scope.getJson();

});

app.controller('newMediasController', ['$scope', '$modalInstance', 'FileUploader', function($scope,$modalInstance, FileUploader) {

  $scope.salvar = function(){
    alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };

  var uploader = $scope.uploader = new FileUploader({
              url: 'upload.php'
          });

          // FILTERS

          uploader.filters.push({
              name: 'customFilter',
              fn: function(item /*{File|FileLikeObject}*/, options) {
                  return this.queue.length < 10;
              }
          });

          // CALLBACKS

          uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
              console.info('onWhenAddingFileFailed', item, filter, options);
          };
          uploader.onAfterAddingFile = function(fileItem) {
              console.info('onAfterAddingFile', fileItem);
          };
          uploader.onAfterAddingAll = function(addedFileItems) {
              console.info('onAfterAddingAll', addedFileItems);
          };
          uploader.onBeforeUploadItem = function(item) {
              console.info('onBeforeUploadItem', item);
          };
          uploader.onProgressItem = function(fileItem, progress) {
              console.info('onProgressItem', fileItem, progress);
          };
          uploader.onProgressAll = function(progress) {
              console.info('onProgressAll', progress);
          };
          uploader.onSuccessItem = function(fileItem, response, status, headers) {
              console.info('onSuccessItem', fileItem, response, status, headers);
          };
          uploader.onErrorItem = function(fileItem, response, status, headers) {
              console.info('onErrorItem', fileItem, response, status, headers);
          };
          uploader.onCancelItem = function(fileItem, response, status, headers) {
              console.info('onCancelItem', fileItem, response, status, headers);
          };
          uploader.onCompleteItem = function(fileItem, response, status, headers) {
              console.info('onCompleteItem', fileItem, response, status, headers);
          };
          uploader.onCompleteAll = function() {
              console.info('onCompleteAll');
          };

          console.info('uploader', uploader);
}]);

//------------Edit Mídias-----------

app.controller('editMediasController', function($scope, $modalInstance){

  $scope.save = function(){
    alert('Editando');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };

});

//-----------------------------------Perfil.php-----------------------------------
app.controller('PerfilController', function($scope, $modal){
  
  $scope.changePassword = function(){
    var modalInstance = $modal.open({
      templateUrl: 'templates/changePasswordModal.html',
      controller: 'changePasswordController',
      backdrop: 'static'
    }); 
  };

});

app.controller('changePasswordController', function($scope, $modalInstance){

  //$scope.errorMessage = '';

  $scope.salvar = function(){
    //alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  
});