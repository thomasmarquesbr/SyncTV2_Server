
<?php 
	include("security.php");

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];


	if(insertUser($username,$email, $password)) 
		expelledVisitor();
	else{
		echo("not ok");

	};
?>
 <!--<div class="modal-header">
            <button type="button" class="close" ng-click="fechar()" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">   
            Mensagem
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-md" ng-click="clickOk()" > Ok </button>
    </div>
		
</div>-->
