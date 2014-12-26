<?php
namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
       $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
       
       //pegar o repositorio da entidade
       $repo = $em->getRepository('Cliente\Entity\DadosCliente');
       
       //buscar todos os dados da tabela cliente
       $dados = $repo->findAll();
       
        //return array(array('dados'=>$dados));
       return new ViewModel(array('dados' => $dados));
    }

    public function formAction()
    {
        
        
        return array();
    }
    
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
