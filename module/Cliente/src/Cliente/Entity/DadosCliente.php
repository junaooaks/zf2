<?php
namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/*
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 * @ORM\Entity(repositoryClass="Cliente\Entity\ClienteRepository")
 */

class DadosCliente {
    /**
     * @ORM\id
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
        return array('id'=>  $this->getId(), 'nome'=>  $this->getNome());
    }


}
