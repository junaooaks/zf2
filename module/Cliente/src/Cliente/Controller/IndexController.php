<?php

namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter,
    Cliente\Form\Formulario as FrmFormulario,
    Cliente\Form\Pesquisa as FrmPesquisa;

class IndexController extends AbstractActionController {

    private $em;
    
    public function indexAction() {
        
        /********inserir formulario de pesquisa**/
        
        $form = new FrmPesquisa();

        /*************************************************/     
        
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
        $paginator->setDefaultItemCountPerPage(5);

        //return array(array('dados'=>$dados));
        return new ViewModel(array('dados' => $paginator, 'page' => $page, 'form' => $form));
    }

    //pegar o formulario
    public function newAction() {
        $form = new FrmFormulario();

        //pegar o request do post
        $request = $this->getRequest();

        //verificar se foi realizado o request
        if ($request->isPost()) {

            //preencher os dados do formulario
            $form->setData($request->getPost());

            //verificar se o formulario esta valido
            if ($form->isValid()) {

                //executar a insert
                $service = $this->getServiceLocator()->get('Cliente\Service\ClienteService');
                $service->insert($request->getPost()->toArray());


                //retirecionar para a pagina de listar
                return $this->redirect()->toRoute('cliente', array('controller' => 'cliente-controller-index'));
            }
        }

        //exibi o formulario na view
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $form = new FrmFormulario();

        //pegar o request do post
        $request = $this->getRequest();

        //pegar o id que esta retornando
        $repository = $this->getEm()->getRepository('Cliente\Entity\DadosCliente');

        //retornar a entidade preenchida
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        //passar paramentro
        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get('Cliente\Service\ClienteService');

                $service->update($request->getPost()->toArray());


                //retirecionar para a pagina de listar
                return $this->redirect()->toRoute('cliente', array('controller' => 'cliente-controller-index'));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function deleteAction() {
        //pegar o servico da categoria
        $service = $this->getServiceLocator()->get('Cliente\Service\ClienteService');
        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute('cliente', array('controller' => 'cliente-controller-index'));
    }

    public function pesquisaAction() {
        
        $form = new FrmPesquisa();

        //pegar o request do post
        $request = $this->getRequest();

        //verificar se foi realizado o request
        if ($request->isPost()) {

            //preencher os dados do formulario
            $form->setData($request->getPost());

            //verificar se o formulario esta valido
            if ($form->isValid()) {

                //executar a insert
                $service = $this->getServiceLocator()->get('Cliente\Service\ClienteService');
                $service->Pesquisa($request->getPost()->toArray());


                //retirecionar para a pagina de listar
                return $this->redirect()->toRoute('cliente', array('controller' => 'cliente-controller-index'));
            }
        }
    }

    protected function getEm() {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }

}
