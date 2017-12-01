<div class="content-wrapper">
	<section class="content-header">
		<h1>Cadastro de Doações</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li>Produtos</li>
			<li class="active">Cadastro de Doações</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Informe os dados da Doação</h3>
					</div>
					<?php
					if (isset ( $msg )) {
						echo '<div class="box-header with-border">' . $msg . '</div>';
					}
					?>
					<div class="box-body">
						<form role="form" action="cadastraproduto" method="post"
							class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="descricaoproduto" class="col-sm-2 control-label">Descrição da Doação</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="nome" name="descricaoproduto"
											placeholder="Informe a descrição da doação" value="<?php echo set_value('descricaoproduto'); ?>">
									</div>
								</div>
								
                                                            <div class="form-group">
									<label for="unidade" class="col-sm-2 control-label">Categoria</label>
									<div class="col-sm-10">
										<select class="form-control" id="unidade" name="unidade">
											<option value="">Selecione...</option>
											<option value="1">Dinheiro</option>
											<option value="2">Alimento</option>
                                                                                        <option value="3">Outros</option>
                                                                                        
										</select>
									</div>
                                                            </div>
								
								<div class="form-group">
									<label for="valormercadoria" class="col-sm-2 control-label">Valor da Doação (R$)</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="valormercadoria"
											name="valormercadoria" placeholder="Informe o valor da doação" value="<?php echo set_value('valormercadoria'); ?>">
											
									</div>
								</div>
                                                            
                                                                <div class="form-group">
									<label for="valorvenda" class="col-sm-2 control-label">Quantidade de itens</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="valorvenda"
											name="valorvenda" placeholder="Informe a quantidade de itens doados" value="<?php echo set_value('valorvenda'); ?>">
											
									</div>
								</div>
                                                            
                                                                <div class="form-group">
									<label for="qtdestoque" class="col-sm-2 control-label">Doador</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="qtdestoque"
											name="qtdestoque" placeholder="Informe quem fez a doação" value="<?php echo set_value('qtdestoque'); ?>">	
									</div>
								</div>
                                                            
                                                            <div class="form-group">
									<label for="descontopermitido" class="col-sm-2 control-label">Data da inclusão</label>

									<div class="col-sm-10">
										<input type="tel" class="form-control" id="descontopermitido"
											name="descontopermitido" placeholder="Informe a data da inclusão" value="<?php echo set_value('descontopermitido'); ?>">	
									</div>
								</div>
                                                            
                                                           
                                                            
                                                            
							<div class="form-group">
								<div class="col-xs-12 col-sm-9 col-lg-9">&nbsp;</div>
								<div class="col-xs-12 col-sm-3 col-lg-3">
									<button type="submit" class="btn btn-primary"
										style="width: 100%">Cadastrar Doação</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="../assets/js/jquery/jquery-2.2.3.min.js"></script>
<script>
	var base_url = '<?php echo base_url() ?>';
	$(document).ready(function () {
		
	});
	function buscaInfo(perfil){
		var perfil = perfil;
		var url = base_url + "home/buscausuarioperfil";
        $.post(url, {
        	perfil: perfil
        }, function (data) {
            $('#resultado').html(data);
        });
	}
</script>
































