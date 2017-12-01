<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Home extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'form_validation' );
		$this->load->helper ( 'form' );
		date_default_timezone_set ( 'America/Sao_Paulo' );
	}
	function index() {
		redirect ( 'login' );
	}
	function logout() {
		$this->session->unset_userdata ( 'logged_in' );
		session_destroy ();
		redirect ( 'home', 'refresh' );
	}
	function dashboard() {
		$this->load->view ( 'view_home' );
	}
	function requicaoajax() {
		if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUARIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			$dados ['tela'] = 'view_requisicaojquery';
			$this->load->view ( 'view_home', $dados );
		} else {
			redirect ( 'login', 'refresh' );
		}
	}
	
	/*
	 * USUARIOS
	 */
	function cadastrausuario() {
		if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUARIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			
			if ($this->input->post ()) {
				if ((! empty ( trim ( $this->input->post ( 'nome' ) ) )) || (! empty ( trim ( $this->input->post ( 'login' ) ) )) || (! empty ( trim ( $this->input->post ( 'email' ) ) )) || (! empty ( trim ( $this->input->post ( 'senha' ) ) )) || (! empty ( trim ( $this->input->post ( 'perfilid' ) ) ))) {
					
					$dadosusuario ['nome'] = $this->input->post ( 'nome' );
					$dadosusuario ['login'] = $this->input->post ( 'login' );
					$dadosusuario ['email'] = $this->input->post ( 'email' );
					$dadosusuario ['senha'] = $this->input->post ( 'senha' );
					$dadosusuario ['datacadastro'] = date ( 'Y-m-d' );
					$dadosusuario ['perfilid'] = $this->input->post ( 'perfilid' );
					$dadosusuario ['status'] = 1;
					
					$this->load->model ( 'model_usuario' );
					$resultadocadastrousuario = $this->model_usuario->cadastrausuario ( $dadosusuario );
					
					if ($resultadocadastrousuario) {
						$dados ['tela'] = 'view_dashboard';
					} else {
                                                $dados ['telaativa'] = 'cadastrausuario';
						$dados ['msg'] = 'Ocorreu um erro ao cadastrar o usuario! Atualize a página e tente novamente';
						$dados ['tela'] = 'usuarios/view_cadastrousuario';
					}
					$this->load->view ( 'view_home', $dados );
				} else {
                                        $dados ['telaativa'] = 'cadastrausuario';
					$dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
					$dados ['tela'] = 'usuarios/view_cadastrousuario';
					$this->load->view ( 'view_home', $dados );
				}
			} else {
                                $dados ['telaativa'] = 'cadastrausuario';
				$dados ['tela'] = 'usuarios/view_cadastrousuario';
				$this->load->view ( 'view_home', $dados );
			}
		}
	}
	
        function listausuario() {
		if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_usuario' );
			$resultadoUsuarios = $this->model_usuario->buscaUsuarios ();
			$dados ['resultadoUsuario'] = $resultadoUsuarios;
			
                        $dados ['telaativa'] = 'listausuario';
			$dados ['tela'] = 'usuarios/view_listausuario';
			$this->load->view ( 'view_home', $dados );
		}
	}
        
        function consultausuario() {
		if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_usuario' );
			if($this->input->post()){
                            if ((! empty ( trim ( $this->input->post ( 'nome' ) ) )) || (! empty ( trim ( $this->input->post ( 'login' ) ) )) || (! empty ( trim ( $this->input->post ( 'email' ) ) ))) {					
					$dadosusuario ['nome'] = $this->input->post ( 'nome' );
					$dadosusuario ['login'] = $this->input->post ( 'login' );
					$dadosusuario ['email'] = $this->input->post ( 'email' );
					
					
					$this->load->model ( 'model_usuario' );
					$resultadousuario = $this->model_usuario->consultausuario( $dadosusuario );

                                        if ($resultadousuario) {
                                                $dados ['telaativa'] = 'listausuario';
                                                $dados ['resultadoUsuario'] = $resultadousuario;
						$dados ['tela'] = 'usuarios/view_listausuario';
                                                $this->load->view ( 'view_home', $dados );
					} else {
                                                $dados ['telaativa'] = 'listausuario';
						$dados ['msg'] = 'Nenhum usuário localizado! Tente novamente';
						$dados ['tela'] = 'usuarios/view_listausuario';
                                                $this->load->view ( 'view_home', $dados );
					}
				} else {
                                        $dados ['telaativa'] = 'consultausuario';
					$dados ['msg'] = 'Dados Incompletos! Preencha os dados e tente novamente';
					$dados ['tela'] = 'usuarios/view_formconsultausuario';
					$this->load->view ( 'view_home', $dados );
                        }
                        
                                }else if($this->input->get()){
                                    if($this->input->get('id')){
                                        $id = (int)$this->input->get('id');
                                        
                                        $this->load->model ( 'model_usuario' );
					$resultadousuarioespecifico = $this->model_usuario->consultausuarioespecifico( $id );
                                         
                                        if ($resultadousuarioespecifico) {
                                                $dados ['resultadoUsuarioEspecifico'] = $resultadousuarioespecifico;
						$dados ['tela'] = 'usuarios/view_formalterausuario';
                                                $this->load->view ( 'view_home', $dados );
					} else {
                                                $dados ['telaativa'] = 'listausuario';
						$dados ['msg'] = 'Nenhum usuário localizado! Tente novamente';
						$dados ['tela'] = 'usuarios/view_listausuario';
                                                $this->load->view ( 'view_home', $dados );
					}
                                    }
                                }
                        
                        else{
                            $dados ['tela'] = 'usuarios/view_formconsultausuario';
                            $this->load->view ( 'view_home', $dados );
                        }
		}
        }
        
        Function atualizausuario(){
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			
			if ($this->input->post ()) {
				if ((! empty ( trim ( $this->input->post ( 'id' ) ) )) || (! empty ( trim ( $this->input->post ( 'nome' ) ) )) || (! empty ( trim ( $this->input->post ( 'login' ) ) )) || (! empty ( trim ( $this->input->post ( 'email' ) ) ))) {
					
					$dadosusuario ['id'] = $this->input->post ( 'id' );
                                        $dadosusuario ['nome'] = $this->input->post ( 'nome' );
					$dadosusuario ['login'] = $this->input->post ( 'login' );
					$dadosusuario ['email'] = $this->input->post ( 'email' );


					$this->load->model ( 'model_usuario' );
					$resultadoatualizausuario = $this->model_usuario->atualizausuario( $dadosusuario );
					
					if ($resultadoatualizausuario) {
                                                $dados ['telaativa'] = 'consultausuario';
                                                $dados ['msg'] = 'Usuário alterado com sucesso!';                                          
						$dados ['tela'] = 'usuarios/view_formconsultausuario';
                                                $this->load->view ( 'view_home', $dados );
					} else {
                                                $dados ['telaativa'] = 'consultausuario';
						$dados ['msg'] = 'Ocorreu um erro ao alterar o usuário! Atualize a página e tente novamente';
						$dados ['tela'] = 'usuarios/view_formconsultausuario';
                                                $this->load->view ( 'view_home', $dados );
					}
					
				} else {
                                        $dados ['telaativa'] = 'consultausuario';
					$dados ['msg'] = 'Dados Incompletos! Preencha os dados e tente novamente';
					$dados ['tela'] = 'usuarios/view_formconsultausuario';
					$this->load->view ( 'view_home', $dados );
				}
			} else {
                                $dados ['telaativa'] = 'listausuario';
				$dados ['tela'] = 'usuarios/view_cadastrousuario';
				$this->load->view ( 'view_home', $dados );
			}
		}
        }
        
        /*
         * CLIENTES
         */ 
        function cadastracliente() {
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUARIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
                        
                        if ($this->input->post ()) {
				if ((! empty ( trim ( $this->input->post ( 'nomefantasia' ) ) )) && (! empty ( trim ( $this->input->post ( 'razaosocial' ) ) )) &&
                                    //(! empty ( trim ( $this->input->post ( 'cnpj' ) ) )) && (! empty ( trim ( $this->input->post ( 'cpf' ) ) )) &&
                                    (! empty ( trim ( $this->input->post ( 'telefone' ) ) )) && (! empty ( trim ( $this->input->post ( 'celular' ) ) )) && (! empty ( trim ( $this->input->post ( 'email' ) ) )) && (! empty ( trim ( $this->input->post ( 'endereco' ) ) )) &&
                                    (! empty ( trim ( $this->input->post ( 'complemento' ) ) )) && (! empty ( trim ( $this->input->post ( 'bairro' ) ) )) && (! empty ( trim ( $this->input->post ( 'cidade' ) ) )) && (! empty ( trim ( $this->input->post ( 'estado' ) ) )) &&
                                    (! empty ( trim ( $this->input->post ( 'cep' ) ) ))) 
                                    
                                    {
                                        $dadoscliente ['nomefantasia'] = $this->input->post ( 'nomefantasia' );
					$dadoscliente ['razaosocial'] = $this->input->post ( 'razaosocial' );
					$dadoscliente ['cnpj'] = $this->input->post ( 'cnpj' );
					$dadoscliente ['cpf'] = $this->input->post ( 'cpf' );
					$dadoscliente ['telefone'] = $this->input->post ( 'telefone' );
					$dadoscliente ['celular'] = $this->input->post ( 'celular' );
					$dadoscliente ['email'] = $this->input->post ( 'email' );
					$dadoscliente ['endereco'] = $this->input->post ( 'endereco' );
					$dadoscliente ['complemento'] = $this->input->post ( 'complemento' );
					$dadoscliente ['bairro'] = $this->input->post ( 'bairro' );
					$dadoscliente ['cidade'] = $this->input->post ( 'cidade' );
					$dadoscliente ['estado'] = $this->input->post ( 'estado' );
					$dadoscliente ['cep'] = $this->input->post ( 'cep' );
                                        
                                        
                                        
                                        
					$this->load->model ( 'model_cliente' );
					$resultadocadastrocliente = $this->model_cliente->cadastracliente ( $dadoscliente );
                                        
 
					
					if ($resultadocadastrocliente) {
						$dados ['telaativa'] = 'clientes';
                                                $dados ['msg'] = 'Cliente cadastrado com sucesso!!!';
						$dados ['tela'] = 'clientes/view_cadastrocliente';
                                                
                                                
					} else {
						$dados ['telaativa'] = 'clientes';
                                                $dados ['msg'] = 'Ocorreu um erro ao cadastrar o usuário! Atualize a página e tente novamente';
						$dados ['tela'] = 'clientes/view_cadastrocliente';
					}
					$this->load->view ( 'view_home', $dados );
                           		} else {
                                                $dados ['telaativa'] = 'clientes';
                                                $dados ['msg'] = 'Dados incompletos! Preencha os dados e tente novamente';
						$dados ['tela'] = 'clientes/view_cadastrocliente';
                                                $this->load->view ( 'view_home', $dados );
                                        }        
                                        
                                        
                                        } else {
                                                $dados ['telaativa'] = 'clientes';                          
						$dados ['tela'] = 'clientes/view_cadastrocliente';
                                                $this->load->view ( 'view_home', $dados );
       
                            }
                        }                
                    }
                    
        Function consultacliente(){
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			
			if ($this->input->post ()) {
                            } else { 
                                $dados ['telaativa'] = 'clientes';                                          
                                $dados ['tela'] = 'clientes/view_formconsultacliente';
                                $this->load->view ( 'view_home', $dados );
			}
		}
        }

         Function listacliente(){
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			
			if ($this->input->post ()) {
                            } else { 
                                $dados ['telaativa'] = 'clientes';                                          
                                $dados ['tela'] = 'clientes/view_listacliente';
                                $this->load->view ( 'view_home', $dados );
			}
		}
        }
                    
        /*
         * PRODUTOS
         */            
					
         function cadastraproduto() {
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUARIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
                        
                        if ($this->input->post ()) 
                                    {
				if( (! empty ( trim ( $this->input->post ( 'descricaoproduto' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'unidade' ) ) )) &&
                                    (! empty ( trim ( $this->input->post ( 'valormercadoria' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'valorvenda' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'qtdestoque' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'descontopermitido' ) ) )) &&
                                    (! empty ( trim ( $this->input->post ( 'alertaestoque' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'qtdvendaminima' ) ) )) && 
                                    (! empty ( trim ( $this->input->post ( 'qtdvalorminimo' ) ) )) ) 
                                    {
                                        $dadoscliente  ['descricaoproduto'] = $this->input->post ( 'descricaoproduto' );
					$dadoscliente  ['unidade'] = $this->input->post ( 'unidade' );
					$dadoscliente  ['valormercadoria'] = $this->input->post ( 'valormercadoria' );
					$dadoscliente  ['valorvenda'] = $this->input->post ( 'valorvenda' );
					$dadoscliente  ['qtdestoque'] = $this->input->post ( 'qtdestoque' );
					$dadoscliente  ['descontopermitido'] = $this->input->post ( 'descontopermitido' );
					$dadoscliente  ['alertaestoque'] = $this->input->post ( 'alertaestoque' );
					$dadoscliente  ['qtdvendaminima'] = $this->input->post ( 'qtdvendaminima' );
					$dadoscliente  ['qtdvalorminimo'] = $this->input->post ( 'qtdvalorminimo' );

                                        
					$this->load->model ( 'model_produto' );
					$resultadocadastroproduto = $this->model_produto->cadastraproduto ( $dadoscliente );
                                        
 
					
					if ($resultadocadastroproduto) {
						$dados ['telaativa'] = 'produtos';
                                                $dados ['msg'] = 'Produto cadastrado com sucesso!!!';
						$dados ['tela'] = 'produtos/view_listaproduto';
                                                
                                                
					} else {
						$dados ['telaativa'] = 'produtos';
                                                $dados ['msg'] = 'Ocorreu um erro ao cadastrar o produto! Atualize a página e tente novamente';
						$dados ['tela'] = 'produtos/view_cadastroproduto';
					}
					$this->load->view ( 'view_home', $dados );
                           		} else {
                                                $dados ['telaativa'] = 'produtos';
                                                $dados ['msg'] = 'Dados incompletos! Preencha os dados e tente novamente';
						$dados ['tela'] = 'produtos/view_cadastroproduto';
                                                $this->load->view ( 'view_home', $dados );
                                        }        
                                        
                                        
                                        } else {
                                                $dados ['telaativa'] = 'produtos';                          
						$dados ['tela'] = 'produtos/view_cadastroproduto';
                                                $this->load->view ( 'view_home', $dados );
       
                            }
                        }                
                    }
                    
                    Function listaproduto(){
            if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$this->load->model ( 'model_perfil' );
			$resultadoPerfil = $this->model_perfil->buscaPerfil ();
			$dados ['resultadoPerfil'] = $resultadoPerfil;
			
			if ($this->input->post ()) {
                            } else { 
                                $dados ['telaativa'] = 'produtos';                                          
                                $dados ['tela'] = 'produtos/view_listaproduto';
                                $this->load->view ( 'view_home', $dados );
			}
		}
        }

	function buscausuarioperfil() {
		if ($this->session->userdata ( 'logged_in' )) { // VALIDA USUÁRIO LOGADO
			$option = "";
			
			if ($this->input->post ()) {
				$perfil = $this->input->post ( 'perfil' );
				$this->load->model ( 'model_usuario' );
				$resultadoUsuarioPerfil = $this->model_usuario->buscaUsuarioPerfil ( $perfil );
				if ($resultadoUsuarioPerfil) {
					foreach ( $resultadoUsuarioPerfil as $Usuario ) {
						$option .= $Usuario->nome. ", " ;
					}
				} else {
					$option .= 'Nenhum Valor Encontrado';
				}
			} else {
				$option .= 'Nenhum Valor Encontrado';
			}
			echo $option;
		}
	}
}
