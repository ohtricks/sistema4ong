  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/datatables/dataTables.bootstrap.css">
  
  <div class="content-wrapper">
	<section class="content-header">
		<h1>Lista de Doadores</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li>Doadores</li>
			<li class="active">Lista de Doadores</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<div class="box box-warning">
					
					<?php
					if (isset ( $msg )) {
						echo '<div class="box-header with-border">' . $msg . '</div>';
					}
					?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Lista de Doadores localizados</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
                                                                        <tr>        
                                                                                <th style="width:24px">&nbsp;</th>
										<th>Nome Fantasia</th>
										<th>Razão Social</th>
										<th>E-mail</th>
										<th>Estado</th>
										
									</tr>
								</thead>
								<tbody>
									<?php 
										if(isset($resultadoUsuario)){
											foreach ($resultadoUsuario as $usuarios){
												?>
                                                                                                <tr>                                
                                                                                                        <td><a href="consultausuario?id=<?php echo $usuarios->id;?>"><i class="fa fa-pencil-square-o"></i></a></td>
													<td><?php echo $usuarios->nome; ?></td>
													<td><?php echo $usuarios->login; ?></td>
													<td><?php echo $usuarios->email; ?></td>
													<td><?php echo $usuarios->datacadastro; ?></td>
													<td><?php echo $usuarios->dataultimoacesso; ?></td>
												</tr>
												<?php 
											}
										}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="../assets/js/jquery/jquery-2.2.3.min.js"></script>


<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
<script src="../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
	var base_url = '<?php echo base_url() ?>';
	$(document).ready(function () {
		
	});
	$(function () {
    	$('#example1').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
		});
	});
</script>
































