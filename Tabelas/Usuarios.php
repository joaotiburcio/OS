<?php

namespace OS\Tabelas;

class Usuarios 
{
    protected $id;
    protected $login;
    protected $senha = "";
    protected $nome = "";
    protected $area_id;
    
    protected $pdo;


    public function __construct(\PDO $pdo) 
    {
        $this->pdo = $pdo;
    }
            
    function getId() 
    {
        return $this->id;
    }

    function getLogin() 
    {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getNome() {
        return $this->nome;
    }

    function getArea() 
    {
        return $this->area_id;
    }


    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) 
    {
        $this->senha = md5($senha);
    }

    function setNome($nome) 
    {
        $this->nome = $nome;
    }

    function setArea(Area $area_id) 
    {
        $this->area_id = $area_id;
    }

    /**
     * 
     * @param int $id
     * @return \OS\Tabelas\Usuarios
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $prep = $this->pdo->prepare($sql);
        $prep->execute(array($id));
        
        return $prep->fetchObject(__CLASS__, array($this->pdo));
        
    }

}
