<?php
namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter,
    Cliente\Form\Formulario as FrmFormulario;

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
       $paginator->setDefaultItemCountPerPage(10);
       
        //return array(array('dados'=>$dados));
       return new ViewModel(array('dados' => $paginator,'page'=>$page));
    }
    
    //pegar o formulario
    public function newAction(){
        $form = new FrmFormulario();
        
        //pegar o request do post
        $request = $this->getRequest();
        
        //verificar se foi realizado o request
        if($request->isPost()){
            //preencher os dados do formulario
            $form->setData($request->getPost());
            
            //verificar se o formulario esta valido
            if($form->isValid()){
                //executar a insert
               
                $service = $this->getServiceLocator()->get('Cliente\Service\ClienteService');
                $service->insert($request->getPost()->toArray());
                
                 
                //retirecionar para a pagina de listar
                //return $this->redirect()->toRoute('cliente',array('controller'=>'categorias'));
                
            }
        }
        
        //exibi o formulario na view
        return new ViewModel(array('form'=>$form));
    }

        
    
    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
