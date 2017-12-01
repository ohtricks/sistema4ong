<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Model_produto extends CI_Model {

    function cadastraproduto($dados = NULL){
        if($dados !== NULL) {
            $this->db->insert('produto', $dados);
            return true;
        }else {
            return false;
        }
    
    }
    
    
}