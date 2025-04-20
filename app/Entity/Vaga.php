<?php
namespace App\Entity;
use \App\Db\Database;
use \PDO;

class Vaga
{
    /*
      Identificador único da vaga
      @var integer
     */
    public $ID;

    /*
      Título da vaga
      @var string
     */
    public $TITLE;

    /*
      Descrição da vaga (pode conter HTML)
      @var string
     */
    public $DESCRIPTION;

    /*
      Define se a vaga está ativa ou inativa
      @var string(y/n)
     */
    public $ACTIVE;

    /*
      Data em que a vaga foi publicada
      @var string
     */
    public $DATA;

    /*
      Método responsável por cadastrar uma nova vaga
      @return boolean
    */
    public function cadastrar()
    {
        // DEFINIR A DATA
        $this -> DATA = date('Y-m-d H:i:s');

        // INSERIR A VAGA NO BANCO DE DADOS
        // ATRIBUIR O ID NA INSTANCIA
        $database = new Database('VAGAS');
        $this -> id = $database -> insert(array(
            "TITLE" => $this -> TITLE,
            "DESCRIPTION" => $this -> DESCRIPTION,
            "ACTIVE" => $this -> ACTIVE,
            "DATA" => $this -> DATA
        ));

        // RETORNAR SUCESSO
        return true;
    }

    /*
      Método responsável por atualizar a vaga no banco de dados
      @return boolean
     */
    public function atualizar()
    {
        return (new Database("VAGAS")) -> update("ID = ".$this -> ID, array(
            "TITLE" => $this -> TITLE,
            "DESCRIPTION" => $this -> DESCRIPTION,
            "ACTIVE" => $this -> ACTIVE,
            "DATA" => $this -> DATA
        ));
    }

    /*
      Método responsável por deletar uma vaga
      @return boolean
    */
    public function excluir()
    {
        return (new Database("VAGAS")) -> delete("ID = ".$this -> ID);
    }

    /*
      Método responsável por obter as vagas do banco de dados
      @param string $where
      @param string $order
      @param string $limit
      @return array
     */
    public static function getVagas ($where = null, $order = null, $limit = null)
    {
        return (new Database("VAGAS")) -> select($where, $order, $limit)
                                       // RETORNA UM OBJETO DE CLASSE DE INSTANCIA DA PROPRIA CLASSE
                                       ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /*
      Método responsável por buscar uma vaga com base no seu id
      @param integer $id
      @return Vaga
     */
    public static function getVaga($id)
    {
        return (new Database("VAGAS")) -> select("ID = $id")
                                        // BUSCAR APENAS UM OBJETO, INSTANCIANDO A PROPRIA CLASSE
                                       ->fetchObject(self::class);
    }

}

?>
