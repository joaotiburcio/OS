<?php


namespace OS\Tabelas;

class Tarefas
{

    protected $id;
    protected $usuario_id_criado;
    protected $usuario_id_atribuido;
    protected $area_id;
    protected $datacriacao;
    protected $observacao;
    protected $descricao;
    protected $status;
    protected $prioridade;
    protected $prazo;
    protected $pdo;
    protected $titulo;


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
        $this->area_id = $objArea->getId();
    }
    
    /**
     * 
     * @param \OS\Tabelas\Usuarios $objUsuario
     */
    
    public function setUsuarioCriado(Usuarios $objUsuario) // leias -se (\OS\Tabelas\Usuarios)
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
    
    public function  setDataCriacao(\DateTime $data)
    {
    $this->datacriacao= $data;
    }
    
    /**
     * 
     * @param string $valor
     */
    public function  setDescricao($valor)
    {
    $this->descricao= $valor;
    }
    
    /**
     * 
     * @param string $valor
     */
    public function  setObservacao($valor)
    {
    $this->observacao= $valor;
    }
    
    /**
     * 
     * @param id $valor
     */
    
    public function  setStatus($valor)
    {
    $this->status= $valor;
    }
    
    
    /**
     * 
     * @param int $valor
     * @throws  \Exception
     */
    public function  setPrioridade($valor)
    {
         if(!is_numeric($valor))
        {
            throw new Exception('Voce não informou um numero valido!');// LOG ERROS.
        }
    $this->prioridade= $valor;
    }
    
    /**
     * 
     * @param int $valor
     */
    
    public function  setPrazo($valor)
    {
    $this->prazo= $valor;
    }
    
    public function getPrazo()
    {
        return $this->prazo;
    }
    
    public function getPrioridade()
    {
       
        return $this->prioridade;
    }
    
    public function getObservacao()
    {
        return $this->observacao;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getDataCriacao()
    {
        return $this->datacriacao;
    }
    
    public function getUsuarioAtribuido()
    {
        return $this->usuario_id_atribuido;
    }
    
    public function getUsuarioCriado()
    {
        return $this->usuario_id_criado;
    }
    
    public function getArea()
    {
        return $this->area_id;
    }
    
    public function getid()
    {
        return $this->id;
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
     * @return \OS\Tabeals\Tarefas
     */
    
    public function   findAll()
    {
        $sql = "SELECT t.id, u.nome AS usuario, a.nome AS area ,t.datacriacao, t.descricao, t.observacao, t.status, t.prioridade, t.prazo, t.titulo 
            FROM tarefas t ,usuarios u, area a
            WHERE t.usuario_id_criado=u.id
            AND t.area_id= a.id";
        
        $lista = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS,__CLASS__, array($this->pdo));
        
        return $lista;
    }
        
    
    /**
     * salva o registro na base de dados
     */
    public function save()
    {
        $sql = "INSERT INTO tarefas (usuario_id_criado, usuario_id_atribuido,
            area_id , datacriacao, descricao, observacao, status, prioridade, 
            prazo, titulo)
            VALUES (1, 1, 1, '2010-10-10 10:10:10', 'uma descricao aqui' ,
            'observacao add ',0, 1 ,5 ,  'um teste novo')" ;
    }
   


    
}
