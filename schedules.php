<div ng-controller="schedulesController">

	<table class="flat-table flat-table-1">
		<thead>
			<th>Name</th>
			<th>Country</th>
			<th>Actions</th>
			<th>Actions</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<tr ng-repeat="x in names">
				<td>{{ x.Name }}</td>
				<td>{{ x.City }}</td>
				<td>  </td>
				<td>  </td>
				<td>  </td>
			</tr>
		</tbody>
	</table>
	

	<div align="right" style="margin-top: 20px; margin-bottom: 20px">		
			<button class="btn btn-custom-spin btn-md" ng-click="newSchedule()"><span class="glyphicon glyphicon-plus-sign"></span> Novo</button>	
	</div>
<!--	
	<div id="modalNewSchedule" class="modal fade" >
	      <div class="modal-dialog">
	          <div class="modal-content">
	              <div class="modal-header">
	                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                  <h3 class="modal-title">Preencha os dados da Programação</h3>
	              </div>
	              <form class="form-horizontal" role="form" name="newChannelForm">
	              	<div class="modal-body">
		                <div class="form-group" ng-class="{ 'has-error' : newChannelForm.channelName.$invalid && !newChannelForm.channelName.$pristine }">
			                <label class="col-md-2 control-label" for="channelName">Canal: </label>
			                <div class="col-md-6">
			                  <input type="text" class="form-control input-md" name="channelName" placeholder="Digite o nome do canal" ng-model="channelName" required>
			                  <p ng-show="newChannelForm.channelName.$invalid && !newChannelForm.channelName.$pristine" class="help-block">Campo obrigatório</p>
			                </div>
		                </div>  
						<div class="form-group">
			                <label class="col-md-2 control-label" for="descChannel">Descrição: </label>
			                <div class="col-md-6">
			                  <textarea type="text" class="form-control input-md" name="descChannel" placeholder="Digite uma descrição para o canal" rows="3" ng-model="descChannel" ></textarea>
			                  <p class="help-block">(Opcional)</p>
			                </div>
		                </div> 
		                

	                    <p class="text-danger">{{ErrorMessage}}</p>
	                    <p class="text-warning"><small>Se você não cadastrar, os campos preenchidos serão perdidos.</small></p>
		                
					</div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Fechar</button>
	                    <button type="button" class="btn btn-custom-spin btn-md" ng-disabled="newChannelForm.$invalid">Cadastrar</button>
	                </div>
	              </form>
	        </div>
	    </div>
	</div>
	-->

</div>

	

	







