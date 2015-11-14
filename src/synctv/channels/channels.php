<div ng-controller="channelsController" >
	
	<table class="flat-table flat-table-1">
		<thead>
			<th>Nome</th>
			<th>Descrição</th>
			<th style="width: 10px;">Ações</th>
		</thead>
		<tbody>
			<tr ng-repeat="channel in table.channels" >
				<td>{{ channel.name }}</td>
				<td>{{ channel.description }}</td>
				<td style="white-space:nowrap;">
					<button class="btn btn-default btn-md" ng-click="editChannel(channel)"><span class="glyphicon glyphicon-edit"></span></button>
					<button class="btn btn-default btn-md" ng-click="removeChannel(channel)"><span class="glyphicon glyphicon-trash"></span></button>
				</td>
		</tbody>
	</table>
	

	<div align="right" style="margin-top: 20px; margin-bottom: 20px">		
		<button class="btn btn-default btn-md" ng-click="removeAllChannel()"><span class="glyphicon glyphicon-trash"></span> Remover Tudo</button>
		<button class="btn btn-danger btn-md" ng-click="newChannel()"><span class="glyphicon glyphicon-plus-sign"></span> Novo</button>	
	</div>



<!--
	<div id="modalNewChannel" class="modal fade">
	      <div class="modal-dialog">
	          <div class="modal-content">
	              <div class="modal-header">
	                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                  <h3 class="modal-title">Preencha os dados do Canal</h3>
	              </div>
	              <form class="form-horizontal" role="form" name="newChannelForm">
	              	<div class="modal-body">
		                <div class="form-group" ng-class="{ 'has-error' : newChannelForm.channelName.$invalid && !newChannelForm.channelName.$pristine }">
			                <label class="col-md-3 control-label" for="channelName">Canal: </label>
			                <div class="col-md-8">
			                  <input type="text" class="form-control input-md" name="channelName" placeholder="Digite o nome do canal" ng-model="channelName" required>
			                  <p ng-show="newChannelForm.channelName.$invalid && !newChannelForm.channelName.$pristine" class="help-block">Campo obrigatório</p>
			                </div>
		                </div>  
						<div class="form-group">
			                <label class="col-md-3 control-label" for="descChannel">Descrição: </label>
			                <div class="col-md-8">
			                  <textarea type="text" class="form-control input-md" name="descChannel" placeholder="Digite uma descrição para o canal" rows="5" ng-model="descChannel" ></textarea>
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


