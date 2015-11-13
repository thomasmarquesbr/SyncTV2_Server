<div ng-controller="multimidiaController" >
	
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
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	

	<div align="right" style="margin-top: 20px; margin-bottom: 20px">	
		<button class="btn btn-custom-spin btn-md" ng-click="editMedias()"><span class="glyphicon glyphicon-edit"></span> Editar</button>	
		<button class="btn btn-custom-spin btn-md" ng-click="newMedias()"><span class="glyphicon glyphicon-plus-sign"></span> Novo</button>	
	</div>

</div>
