<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<button class="btn btn-sm btn-primary btn-block" type='button' id="new_department"><i class="fa fa-plus"></i> Adicionar Departamento</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM departments order by  name asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['description'] ?></b></td>
						<td class="text-center ">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Nenhuma
		                    </button>
		                    <div class="dropdown-menu">
		                      <a class="dropdown-item edit_department" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Editar</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_department" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Deletar</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('#new_department').click(function(){
		uni_modal("Novo departamento","manage_department.php")
	})
	$('.edit_department').click(function(){
		uni_modal("Edit Department","manage_department.php?id="+$(this).attr('data-id'))
	})
	$('.delete_department').click(function(){
	_conf("Tem certeza que deseja excluir este departamento?","delete_department",[$(this).attr('data-id')])
	})
	
	})
	function delete_department($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_department',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Dados excluídos com sucesso",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>