<?php
namespace Cliente\Form;

use Zend\Form\Form;


class Formulario extends Form {
    
    public function __construct($name = null) {
        parent::__construct('formulario');
        
        $this->setAttribute('method', 'post');
        //inserir a class de filtrar formulario
        //$this->setInputFilter(new FormularioFilter);
        
//        $this->add(array(
//            'name'=>'id',
//            'attributes'=>array(
//                'type'=>'hidden'
//            )
//        ));
        
        $this->add(array(
            'name'=>'nome',
            'options'=>array(
                'type'=>'text',
                'label'=>'Nome'
            ),
            'attributes'=>array(
                'id'=>'nome',
                'placeholder'=>'Entre com o nome'
            )
        ));
        
        $this->add(array(
           'name'=>'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes'=>array(
                'value'=>'Salvar',
                'class'=>'btn-success'
            )
        ));
    }
    
}
