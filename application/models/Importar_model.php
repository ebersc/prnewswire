<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Importar_model extends CI_Model
{

    function __construct()
    {
        $this->table = 'noticias';
    }

    /**
     * Cria um nova lista de newsletters
     */
    public function novaLista(){
        $this->db->insert('lista_noticias', array('date' => date('Y-m-d')));
    }

    /**
     * Gravar as newsletters no banco de dados
     */
    public function inserir_noticias($arrDados){

        $arrDados['lista_noticias_id'] = $this->getLastID();

        $this->db->insert($this->table, $arrDados);
    }

    /**
     * Buscando a lista de newsletters mais recente
     */
    public function getAll(){
        $resul = $this->db->select('*')
            ->from($this->table)
            ->where('lista_noticias_id = (SELECT MAX(ID) FROM lista_noticias)')
            ->order_by('title', 'asc')
            ->get();

        if($resul->num_rows() > 0){
            return $resul->result_array();
        }else{
            return array();
        }
    }

    /**
     * Busca o ID da ultima lista de newsletters
     */
    function getLastID(){
        $resul = $this->db->select('ID')
            ->from('lista_noticias')
            ->order_by('ID', 'desc')
            ->limit(1)
            ->get();
        return $resul->result_array()[0]['ID'];
    }
}
