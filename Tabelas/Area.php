<?php

namespace OS\Tabelas;

/**
 * Mapea a tabela area
 * 
 * @author Edir
 * @since 27-05-2015
 * @package OS\Tabelas
 * @version 1.0-beta
 * 
 */
class Area implements \JsonSerializable
{
    protected $id;
    protected $nome;
    
    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) 
    {
        $this->pdo = $pdo;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    /**
     * 
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    
    public function save()
    {
        if($this->id == "")
        {
            $sql = 'INSERT INTO area ("nome") VALUES (?)';
            $prep = $this->pdo->prepare($sql);
            $prep->execute(array($this->nome));        
        } else 
        {
            $sql = 'UPDATE area SET nome = ? WHERE id=?';
            $prep = $this->pdo->prepare($sql);
            $prep->execute(array($this->nome, $this->id)); 
        }
        
    }
    
    /**
     * Lista todas as areas cadastras
     * @author Edir
     * @return Area
     */
    static public function listAll(\PDO $pdo = null)
    {
       
        $sql = "SELECT id, nome FROM area";
        $retorno = $pdo
                ->query($sql)
                ->fetchAll(\PDO::FETCH_CLASS, 'OS\Tabelas\Area', array($pdo));
        return $retorno;
    }
    
    /**
     * Retorna um objeto Area, com o nome especificado
     * 
     * @param string $valor
     * @return \OS\Tabelas\Area
     */
    public function findByNome($valor)
    {
        return $this->findBy('nome', $valor);
    }
    
    /**
     * 
     * @param int $valor
     * @return Area
     */
    public function findById($valor)
    {
        return $this->findBy('id', $valor);
    }
    
    /**
     * 
     * @param string $coluna Nome da coluna da tabela
     * @param string $valor Valor a ser pesquisado
     * @return type
     */
    protected function findBy($coluna, $valor)
    {
        try{
            $sql = 'SELECT id, nome FROM area WHERE '.$coluna.' = :valor';
            
            $prep = $this->pdo->prepare($sql);
            $prep->bindValue(':valor', $valor);
            $prep->execute();
            $retorno = $prep->fetchObject('OS\Tabelas\Area', array($this->pdo));

            return $retorno;
        } catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    /**
     * Deleta o registro
     */
    public function delete()
    {
        $sql = 'DELETE FROM area WHERE id = ?';
        $prep = $this->pdo->prepare($sql);
        $prep->execute(array($this->id));
    }
    
    public function __toString() 
    {
        return $this->id.': '.$this->nome;
    }
    
    public function jsonSerialize() 
    {
        return array ('id'=> $this->id , 'nome'=>  $this->nome );
    }

}
