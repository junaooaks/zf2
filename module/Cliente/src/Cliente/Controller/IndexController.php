<?php
namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
       $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
       
       //pegar o repositorio da entidade
       $repo = $em->getRepository('Cliente\Entity\ClienteRepository');
       
       
       //buscar todos os dados da tabela cliente
       $dados = $repo->findAll();
       
       
       
        return array(array($dados));
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
