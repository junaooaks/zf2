<?php

namespace Cliente\Service;

use Doctrine\ORM\EntityManager,
    Cliente\Entity\DadosCliente,
    Zend\Stdlib\Hydrator\ClassMethods;


class ClienteService{
    
    /**
     * @var EntityManager
     */
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function insert(array $data) {
        
        $entity = new DadosCliente($data);
        
        //caso nao cria a class entity\configurator
        //pear os valores desta forma
        // $entity->setId($data['id']);
        // $entity->setNome($data['nome']);
         
        
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
        
    }
    
    public function update(array $data) {
            
        $entity = $this->em->getReference('Cliente\Entity\DadosCliente', $data['id']);
        
        //automatizar os set da entidade
        $entity = ClassMethods::hydrate($entity, $data);
        
        $this->em->persist($entity);
        
        $this->em->flush();
        
        return $entity;
    }
    
}
