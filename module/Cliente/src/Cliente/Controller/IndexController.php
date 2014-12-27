<?php
namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
       $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
       
       //pegar o repositorio da entidade
       $repo = $em->getRepository('Cliente\Entity\DadosCliente');
       
       //buscar todos os dados da tabela cliente
       $dados = $repo->findAll();
       
       //pegar o parametro da rota da pagina
       $page = $this->params()->fromRoute('page');
       
       //criar uma paginação
       $paginator = new Paginator(new ArrayAdapter($dados));
       $paginator->setCurrentPageNumber($page);
       $paginator->setDefaultItemCountPerPage(1);
       
        //return array(array('dados'=>$dados));
       return new ViewModel(array('dados' => $paginator,'page'=>$page));
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
