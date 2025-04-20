<?php
namespace App\Db;
use \PDO;
use \PDOException;

class Database
{
    /*
      Nome da tabela a ser manipulada
      @var string
     */
    private $table;

    /*
      Instância de PDO
     */
    private $connection;

    /*
      Define a tabela e instancia a conexão
      @param string $table
     */
    public function __construct ($table = null)
    {
        $this -> table = $table;
        $this -> setConnection();
    }

    /*
      Método responsável por criar uma conexão com o Banco de Dados
      Iremos definir uma instância de PDO dentro da propriedade $connection
     */
    private function setConnection()
    {
        try
        {
            // CONEXAO COM O BANCO DE DADOS
            $this -> connection = new PDO("mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME'),getenv('DB_USER'),getenv('DB_PASS'));
            // DEFINE UMA EXCEPTION SEMPRE QUE UM ERRO OCORRER
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e)
        {
            // NUNCA DEVEMOS EXPOR O ERRO DO BD EM PRODUCAO
            die("Error: " . $e -> getMessage());
        }
    }

    /*
      Método responsável por inserir dados no BD
      @param array $values [ field => value ]
      @return integer
     */
    public function insert($values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values);
        
        // PREENCHE ARRAY VAZIO COM O NUMERO DE POSICOES COM O VALOR DEFINIDO
        $binds = array_pad(array(), count($fields), "?");

        // MONTANDO A QUERY BUILDER
        $query = 'INSERT INTO '.$this -> table.'('.implode(',',$fields).') VALUES ('.implode(',', $binds).')';

        // EXECUTA O INSERT
        $this -> execute($query, array_values($values));

        // RETORNA O ID INSERIDO
        return $this -> connection -> lastInsertId();
    }

    /*
      Método responsável por atualizar dados no banco de dados
      @param string $where
      @param array $values
      @return boolean
     */
    public function update ($where, $values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values);
        
        // MONTAR A QUERY
        $query = "UPDATE ".$this->table." SET ".implode("=?,", $fields)."=? WHERE ".$where;

        // EXECUTAR A QUERY
        return $this -> execute($query, array_values($values));
    }

    /*
      Método responsável por deletar um dado do banco de dados
      @return boolean
     */
    public function delete($where)
    {
        // MONTAR A QUERY
        $query = "DELETE FROM ".$this -> table." WHERE ".$where;

        // EXECUTAR A QUERY
        return $this -> execute($query);
    }

    /*
      Método responsável por executar uma consulta no banco de dados
      @param string $where
      @param string $order
      @param string $limit
p      @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields='*')
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        // MONTANDO A QUERY
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        // EXECUTA A QUERY
        return $this -> execute($query);
    }

    /*
      Método responsável por executar queries no BD
      @param string $query
      @param array $params
      @return PDOStatement
     */
    public function execute($query, $params = array())
    {
        try
        {
            $statement = $this -> connection -> prepare($query);
            $statement -> execute($params);
            return $statement;
        } catch (PDOException $e)
        {
            die("Error: " . $e -> getMessage());
        }
    }
}
?>
