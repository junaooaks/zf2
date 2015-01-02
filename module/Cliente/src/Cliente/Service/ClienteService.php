<?php

namespace Cliente\Service;

use Doctrine\ORM\EntityManager,
    Cliente\Entity\DadosCliente;


class ClienteService{
    
    /**
     * @var EntityManager
     */
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function insert(array $data) {
        
        var_dump($data);
        die;
        
        $entity = new DadosCliente($data);
        
        //caso nao cria a class entity\configurator
        //pear os valores desta forma
        // $entity->setId($data['id']);
        // $entity->setNome($data['nome']);
         
        
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
        
    }
            
    
}
