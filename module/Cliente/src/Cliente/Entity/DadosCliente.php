<?php
namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 * @ORM\Entity(repositoryClass="Cliente\Entity\ClienteRepository")
 */

class DadosCliente {
    
    public function __construct($options = null) {
        (new ClassMethods())->hydrate($options, $this);
        
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="text")
     * @var string
     * 
     */
    protected $nome;
    
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function __toString() {
        return $this->nome;
    }
    
    public function toArray(){
        return (new ClassMethods())->extract($this);
    }


}
