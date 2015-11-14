var app = angular.module('SyncTV', ['ui.bootstrap','angularFileUpload'],function($httpProvider){
        // Use x-www-form-urlencoded Content-Type
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

        /**
         * The workhorse; converts an object to x-www-form-urlencoded serialization.
         * @param {Object} obj
         * @return {String}
         */ 
        var param = function(obj) {
          var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

          for(name in obj) {
            value = obj[name];

            if(value instanceof Array) {
              for(i=0; i<value.length; ++i) {
                subValue = value[i];
                fullSubName = name + '[' + i + ']';
                innerObj = {};
                innerObj[fullSubName] = subValue;
                query += param(innerObj) + '&';
              }
            }
            else if(value instanceof Object) {
              for(subName in value) {
                subValue = value[subName];
                fullSubName = name + '[' + subName + ']';
                innerObj = {};
                innerObj[fullSubName] = subValue;
                query += param(innerObj) + '&';
              }
            }
            else if(value !== undefined && value !== null)
              query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
          }

          return query.length ? query.substr(0, query.length - 1) : query;
        };

        // Override $http service's default transformRequest
        $httpProvider.defaults.transformRequest = [function(data) {
          return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
        }];    

});

//-----------------------------------Index.php-----------------------------------

app.controller('LoginController', function($scope, $http, $modal){
  
  $scope.loginData = {};
  $scope.submission = false;
  $scope.submitForm = function() {
    $http({
    method : 'POST',
    url : '../src/security/validateLogin.php',
    data : param($scope.loginData), // pass in data as strings
    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
  })
    .success(function(data) {
      if (!data.success) {
       // if not successful, bind errors to error variables
       $scope.errorUsername = data.errors.username;
       $scope.errorPassword = data.errors.password;
       $scope.submissionMessage = data.messageError;
       $scope.submission = true; //shows the error message
      } else {
      // if successful, bind success message to message
       $scope.submissionMessage = data.messageSuccess;
       $scope.loginData = {}; // form fields are emptied with this line
       $scope.submission = true; //shows the success message
      
      }
     });
   };

  $scope.cadastrar = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/registerModal.html',
      controller: 'LoginModalController',
      backdrop: 'static',
      keyboard: false
    }); 
  };

});

app.controller('LoginModalController', function($http, $scope, $modalInstance,$modal){

  $scope.formData = {};
  // submission message doesn't show when page loads
  $scope.submission = false;
  // Updated code thanks to Yotam
  $scope.submitForm = function() {
    $http({
    method : 'POST',
    url : '../src/security/validateRegister.php',
    data : param($scope.formData), // pass in data as strings
    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
  })
    .success(function(data) {
      if (!data.success) {
       // if not successful, bind errors to error variables
       //$scope.errorUsername = data.errors.username;
       //$scope.errorEmail = data.errors.email;
       $scope.errorPassword = data.errors.password;
       $scope.submissionMessage = data.messageError;
       $scope.submission = true; //shows the error message
      } else {
      // if successful, bind success message to message
       $scope.submissionMessage = data.messageSuccess;
       $scope.formData = {}; // form fields are emptied with this line
       $scope.submission = true; //shows the success message
       $scope.fechar();
       $scope.startAlert();
      }
     });
   };
   $scope.startAlert = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/alertModal.html',
      controller: 'alertModalController',
      resolve: {
        message: function () {
          return $scope.submissionMessage;
        }
      }
    }); 
  };

  $scope.enviar = function(){
    //alert('enviar');
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };
  
});

//----------------------alertModal-----------------------

app.controller('alertModalController', function($scope,$modalInstance,message){
  
  $scope.message = message;
  $scope.ok = function(){
    $modalInstance.close();
  };

  $scope.fechar = function(){
    $modalInstance.dismiss();
  };

});


//-----------------------------------main.php-----------------------------------

app.controller('MainController', function($scope){   

  $scope.isActive = true;
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


app.controller('synctvController', function($scope) {
  $scope.isActive = true;
});


//---------------------------------channels.php---------------------------------

app.controller('channelsController', function ($scope, $http, $modal) {
  
  $scope.table = {};
  $scope.getChannels = function(){
      $http.get("../src/synctv/channels/getChannelsTable.php").success(function(data){
        $scope.table = data; 
        //alert(JSON.stringify(data));
  })};
  $scope.getChannels(); 

  $scope.newChannel = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/newChannelModal.html',
      controller: 'newChannelModalController',
      backdrop: 'static',
      keyboard: false
    }).result
    .then(function (data){
      $scope.getChannels();
    }); 
  };

  $scope.channelEditing = {};
  $scope.editChannel = function(channel){
    $scope.channelEditing = channel;
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/editChannelModal.html',
      controller: ['$scope', '$modalInstance','$http', $scope.editChannelModalController],
      backdrop: 'static',
      keyboard: false
    }).result
    .then(function(data){
      $scope.getChannels();
    });;
  };

  $scope.channelRemove = {};
  $scope.removeChannel = function(channel){
    $scope.channelRemove = channel;
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/removeChannelModal.html',
      controller: ['$scope', '$modalInstance','$http', $scope.removeChannelModalController],
      backdrop: 'static',
      keyboard: false
    }).result
    .then(function(data){
      $scope.getChannels();
    });
  };

  
  $scope.removeAllChannel = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/removeAllChannelsModal.html',
      controller: ['$scope', '$modalInstance','$http', $scope.removeAllChannelsModalController],
      backdrop: 'static',
      keyboard: false
    }).result
    .then(function(data){
      $scope.getChannels();
    });
  };


  //------------------Edit Modal-----------------------------
  $scope.editChannelModalController = function($modalScope, $modalInstance, $http){
    
    $modalScope.channel = angular.copy($scope.channelEditing);
    $scope.submission = false;
    $scope.showError = false;
    $modalScope.save = function(){
      $http({
        method : 'POST',
        url : '../src/synctv/channels/editChannel.php',
        data : $modalScope.channel, // pass in data as strings
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
      })
        .success(function(data) {
          if (!data.success) {
            $scope.submissionMessage = data.errors.message;
            $scope.submission = true; //shows the error message
            $scope.showError = true;
          } else {
          // if successful, bind success message to message
            $scope.submissionMessage = data.message;
            $scope.submission = true; //shows the success message
            $modalInstance.close();
            $modalScope.startAlert();
          }
         });
        };

    $modalScope.fechar = function(){
      $modalInstance.dismiss();
    };

    $modalScope.startAlert = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/alertModal.html',
      controller: 'alertModalController',
      resolve: {
        message: function () {
          return $scope.submissionMessage;
        }
      }
    })}; 

  }

  //---------------------------------------Remove Modal-------------------------------------------
  $scope.removeChannelModalController = function($modalScope, $modalInstance, $http){

    $modalScope.channel = angular.copy($scope.channelRemove);
    $scope.submission = false;
    $scope.showError = false;
    $modalScope.save = function(){
      //alert($scope.channelRemove.name);
      $http({
        method : 'POST',
        url : '../src/synctv/channels/removeChannel.php',
        data : $modalScope.channel, // pass in data as strings
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
      })
        .success(function(data) {
          if (!data.success) {
            $scope.submissionMessage = data.errors.message;
            $scope.submission = true; //shows the error message
            $scope.showError = true;
          } else {
          // if successful, bind success message to message
            $scope.submissionMessage = data.message;
            $scope.submission = true; //shows the success message
            $modalInstance.close();
            $modalScope.startAlert();
          }
         });
        };

    $modalScope.fechar = function(){
      $modalInstance.dismiss();
    };

    $modalScope.startAlert = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/alertModal.html',
      controller: 'alertModalController',
      resolve: {
        message: function () {
          return $scope.submissionMessage;
        }
      }
    })}; 
    
  }

  $scope.removeAllChannelsModalController = function($modalScope, $modalInstance, $http){

    $scope.submission = false;
    $scope.showError = false;
    $modalScope.save = function(){
      //alert($scope.channelRemove.name);
      $http({
        method : 'POST',
        url : '../src/synctv/channels/removeAllChannels.php',
        headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
      })
        .success(function(data) {
          if (!data.success) {
            $scope.submissionMessage = data.errors.message;
            $scope.submission = true; //shows the error message
            $scope.showError = true;
          } else {
          // if successful, bind success message to message
            $scope.submissionMessage = data.message;
            $scope.submission = true; //shows the success message
            $modalInstance.close();
            $modalScope.startAlert();
          }
         });
        };

    $modalScope.fechar = function(){
      $modalInstance.dismiss();
    };

    $modalScope.startAlert = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/alertModal.html',
      controller: 'alertModalController',
      resolve: {
        message: function () {
          return $scope.submissionMessage;
        }
      }
    })}; 
    
  }

});

//---------------------------------New Channel-----------------------------------
app.controller('newChannelModalController', function($scope, $modalInstance,$http, $modal){

  $scope.channel = {};
  $scope.submission = false;
  $scope.showError = false;

  $scope.save = function() {
    $http({
    method : 'POST',
    url : '../src/synctv/channels/addChannel.php',
    data : $scope.channel, // pass in data as strings
    headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
  })
    .success(function(data) {
      if (!data.success) {
        $scope.channelError = data.errors.message;
        $scope.submissionMessage = data.message;
        $scope.submission = true; //shows the error message
        $scope.showError = true;
      } else {
      // if successful, bind success message to message
        $scope.submissionMessage = data.message;
        $scope.channel = {}; // form fields are emptied with this line
        $scope.submission = true; //shows the success message
        $scope.fechar();
        $scope.startAlert();
      }
     });
   };
   $scope.startAlert = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/alertModal.html',
      controller: 'alertModalController',
      resolve: {
        message: function () {
          return $scope.submissionMessage;
        }
      }
    })};   
  

  /*$scope.save = function(){
    $scope.postData();
    $modalInstance.close();
  };*/

  $scope.fechar = function(){
    $modalInstance.close();
  };
  
});


//---------------------------------Schedules.php---------------------------------

app.controller('schedulesController', function($scope, $modal, $http){
  
  $scope.newSchedule = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/newScheduleModal.html',
      controller: 'newScheduleModalController',
      backdrop: 'static',
      keyboard: false
    }); 
  };

  $scope.editSchedule = function(){
    var modalInstance = $modal.open({
      templateUrl: '../src/templates/editScheduleModal.html',
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
      templateUrl: '../src/templates/newMediasModal.html',
      controller: 'newMediasController',
      backdrop: 'static',
      keyboard: false,
      size: 'lg'
    }); 
  };

  $scope.editMedias = function(){
    var modalInstanceInstance = $modal.open({
      templateUrl: '../src/templates/editMediasModal.html',
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
              url: '../uploads/upload.php'
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
      templateUrl: '../src/templates/changePasswordModal.html',
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