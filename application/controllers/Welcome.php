<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Importar_model');
    }

    /**
     * Importa dos dados da pagina e lista os mesmos para o usuário
     */
    public function index()
    {

        $arrResp['arrDados'] = $this->importar();

        unset($_SESSION['dados']);

        $_SESSION['dados'] = $arrResp['arrDados'];

        $arrResp['base_url'] = base_url();


        $this->load->view('welcome_message', $arrResp);
    }

    public function listarNoticia()
    {

        $arrResp['arrDados'] = $this->Importar_model->getAll();

        $arrResp['base_url'] = base_url();

        $this->load->view('listar_newsletter', $arrResp);
    }


    function GetLinkFromObject($object)
    {
        $arrayLink = array();

        $array = json_decode(json_encode($object), 1);

        foreach ($array['item'] as $value) {
            array_push($arrayLink, $value['link']);
        }

        return $arrayLink;

    }

    /**
     * Função que busca as newsletters na pagina para serem listadas
     */
    public function importar()
    {
        try {
            //Desabilitando os erros da libxml
            libxml_use_internal_errors(true);
            $url = 'http://prncloud.com/xml/rss_generico.php?clienteNews=277&paisNews=8';

            //Buscando o conteudo do arquivo XML
            $html = file_get_contents($url);

            $doc = new DOMDocument();

            //Carregando o conteudo do arquivo XML
            $doc->loadHTML($html);

            //Obtendo as tags Xml
            $sxml = simplexml_import_dom($doc);


            $arrLink = $this->GetLinkFromObject(simplexml_load_file($url)->channel);

            //Obtendo apenas o objeto channel retornado pelo simplexml
            $data = $sxml->body->rss->channel;

            //Forçando a conversão do objeto para array
            $arrDados = (array)$data;

            $arrNoticias = array();

            //Separando as informações das noticias para salvar no banco de dados
            for ($i = 0; $i < count($arrDados['item']); $i++) {
                $arrAux = (array)$arrDados['item'][$i];

                $arrAux['category_pais'] = $arrAux['category'][0];
                $arrAux['category_type'] = $arrAux['category'][1];

                $arrAux['link'] = $arrLink[$i];

                unset($arrAux['category']);


                $var = explode(" ", $arrAux['description']);

                $arrAux['description'] = $var[0];
                $arrAux['date'] = $var[1];
                array_push($arrNoticias, $arrAux);
            }

            return $arrNoticias;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }

    /**
     * Grava as newsletters selecionadas no banco de dados
     */
    public function Salvar()
    {

        $array = $_SESSION['dados'];

        $arrDados = $this->input->post('noticias');

        $this->Importar_model->novaLista();

        for ($i = 0; $i < count($array); $i++) {
            if (in_array($i, $arrDados)) {
                $this->Importar_model->inserir_noticias($array[$i]);
            }
        }

    }
}
