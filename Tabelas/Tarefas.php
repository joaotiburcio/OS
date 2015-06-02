<?php

namespace OS\Tabelas;

require_once 'Area.php';
require_once 'Usuarios.php';

class Tarefas 
{
    protected $id;
    /**
     * @var \OS\Tabelas\Usuarios 
     */
    protected $usuario_id_criado;
    /**
     * @var \OS\Tabelas\Usuarios 
     */
    protected $usuario_id_atribuido;
    /**
     * @var \OS\Tabelas\Area 
     */
    protected $area_id;
    /**
     * @var \DateTime 
     */
    protected $datacriacao;
    protected $observacao;
    protected $descricao;
    protected $status;
    protected $prioridade;
    protected $prazo;
    protected $titulo;


    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) 
    {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param \OS\Tabelas\Area $objArea
     */
    public function setArea(\OS\Tabelas\Area $objArea)
    {
        $this->area_id = $objArea;
    }
    
    /**
     * 
     * @param \OS\Tabelas\Usuarios $objUsuario
     */
    public function setUsuarioCriado(Usuarios $objUsuario)
    {
        $this->usuario_id_criado = $objUsuario;
    }
    
    /**
     * 
     * @param \OS\Tabelas\Usuarios $objUsuario
     */
    public function setUsuarioAtribuido(Usuarios $objUsuario)
    {
        $this->usuario_id_atribuido = $objUsuario;
    }
    
    /**
     * 
     * @param \DateTime $data
     */
    public function setDataCriacao(\DateTime $data)
    {
        $this->datacriacao = $data;
    }
    
    /**
     * 
     * @param string $valor
     */
    public function setDescricao($valor)
    {
        $this->descricao = $valor;
    }
    
    /**
     * 
     * @param string $valor
     */
    public function setObservacao($valor)
    {
        $this->observacao = $valor;
    }
    
    /**
     * 
     * @param int $valor
     */
    public function setStatus($valor)
    {
        $this->status = $valor;
    }
    
    /**
     * 
     * @param int $valor
     * @throws \Exception
     */
    public function setPrioridade($valor)
    {
        if(!is_numeric($valor))
        {
            throw new \Exception('Voce não informou um numero válido!');
        }
        $this->prioridade = $valor;
    }
    
    /**
     * 
     * @param int $valor
     */
    public function setPrazo($valor)
    {
        $this->prazo = $valor;
    }
    
    
    public function getPrazo()
    {
        return $this->prazo;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getPrioridade()
    {
        return $this->prioridade;
    }
    
    /**
     * 
     * @return \OS\Tabelas\Area
     */
    public function getArea()
    {
        $area = new \OS\Tabelas\Area($this->pdo);
        return $area->findById($this->area_id);
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getObservacao()
    {
        return $this->observacao;
    }
    
    /**
     * 
     * @return \DateTime
     */
    public function getDataCriacao()
    {
        return $this->datacriacao;
    }
    
    /**
     * 
     * @return \OS\Tabelas\Usuarios
     */
    public function getUsuarioCriado()
    {
        $usuario = new \OS\Tabelas\Usuarios($this->pdo);
        return $usuario->findById($this->usuario_id_criado);
    }
    
    /**
     * 
     * @return \OS\Tabelas\Usuarios
     */
    public function getUsuarioAtribuido()
    {
        $usuario = new \OS\Tabelas\Usuarios($this->pdo);
        
        if ($this->usuario_id_atribuido != "")
        {
            return $usuario->findById($this->usuario_id_atribuido);            
        } else 
        {            
            return $usuario;
        }
    }
    
    /**
     * 
     * @return \OS\Tabelas\Tarefas
     */
    public function findAll()
    {
        $sql = "SELECT t.id,  t.usuario_id_criado, t.area_id, 
                t.datacriacao, t.descricao, t.observacao, 
                t.status, t.prioridade, t.prazo,  t.titulo,
                t.usuario_id_atribuido
            FROM tarefas t, usuarios u, area a
            WHERE t.usuario_id_criado = u.id
            AND t.area_id = a.id";
        
        $lista = $this->pdo->
                query($sql)->
                fetchAll(\PDO::FETCH_CLASS, __CLASS__, array($this->pdo));
        return $lista;
    }
    
    /**
     * Salva o registro na base de dados
     */
    public function save()
    {
        
        $id_usuario = ($this->usuario_id_atribuido 
                        instanceof \OS\Tabelas\Usuarios)?  
                        $this->usuario_id_atribuido->getId():
                        null;
        
        $valores = array(
            //$this->usuario_id_criado->getId(),
            1,
            $id_usuario,
            $this->area_id,
            $this->datacriacao,
            $this->descricao,
            $this->observacao,
            $this->status,
            $this->prioridade,
            $this->prazo,
            $this->titulo
        );
        
        if($this->id == '')
        {
            
            $sql = "INSERT INTO tarefas 
                    (usuario_id_criado, usuario_id_atribuido, 
                    area_id,  datacriacao, descricao, observacao, 
                    status, prioridade, prazo, titulo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
        } else
        {
            $sql = "UPDATE tarefas SET "
                    . "usuario_id_criado = ?, "
                    . "usuario_id_atribuido = ?, "
                    . "area_id = ?, "
                    . "datacriacao = ?, "
                    . "descricao = ?, "
                    . "observacao = ?, "
                    . "status = ?, "
                    . "prioridade = ?, "
                    . "prazo = ?, "
                    . "titulo = ? "
                 . "WHERE id = ?";

            $valores[] = $this->id;
            
        }
        try{
            $prep = $this->pdo->prepare($sql);
            if($prep->execute($valores) == FALSE)
            {
                throw new \Exception('Não executou um sql direito');
            }
        } catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * 
     * @param string $titulo
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * 
     * @param int $id
     * @return \OS\Tabelas\Tarefas
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM tarefas WHERE id = ?";
        $prep = $this->pdo->prepare($sql);
        $prep->execute(array($id));
        
        return $prep->fetchObject('\OS\Tabelas\Tarefas', array($this->pdo));
        
    }
    
    public function findByTitulo($valor)
    {
        $sql = "SELECT *  FROM tarefas WHERE titulo like '%".$valor."%'";                
        
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS, 
                                'OS\Tabelas\Tarefas', 
                                array($this->pdo));
    }
}
