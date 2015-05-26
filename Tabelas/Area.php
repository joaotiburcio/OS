<?php



namespace OS\Tabelas;


class Area 
{

    protected $id;
    
    protected $nome;
    
    protected $pdo;


    public function __construct(\PDO $pdo) 
    {
        $this->pdo = $pdo;
    }
            
    function getId() 
    {
        return $this->id;
    }

    function getNome() 
    {
        return $this->nome;
    }

    function setId($id) 
    {
        $this->id = $id;
    }

    function setNome($nome) 
    {
        $this->nome = $nome;
    }

    public function save()
    {
        $sql = 'INSERT INTO area("nome) VALUES (?)';
            
    }
    
   
}
