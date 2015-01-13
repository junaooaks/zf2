<?php

namespace Cliente\Form;

use Zend\Form\Form;

class Pesquisa extends Form {
    
    public function __construct($name = null) {
        parent::__construct('Pesquisa');
        
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name'=>'nome',
            'options'=>array(
                'type'=>'text',
                'label'=>'Pesquisar:'
            ),
            'attributes'=>array(
                'id'=>'nome',
                'placeholder'=>'Pesquisa Nome Cliente'
            )
        ));
        
        $this->add(array(
           'name'=>'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes'=>array(
                'id'=>'pesquisar',
                'value'=>'...',
                'class'=>'btn-success'
            )
        ));
    }
}
