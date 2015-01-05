<?php

namespace Cliente;

return array(
    'controllers' => array(
        'invokables' => array(
            //'Cliente\Controller\Index' => 'Cliente\Controller\IndexController',

            'cliente-controller-index' => 'Cliente\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cliente' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/cliente',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        //'__NAMESPACE__' => 'Cliente\Controller',
                        'controller' => 'cliente-controller-index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    //Rota para roda a paginação na indexAction
                    'default-index' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/page/:page]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                'controller' => 'cliente-controller-index',
                                'action' => 'index',
                                'page' => 1
                            ),
                        ),
                    ),
                    //Rotas para rodar a paginação em outras action
                    'default-pages' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action][/page/:page]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                'controller' => 'cliente-controller-index',
                                'action' => 'index',
                                'page' => 1
                            ),
                        ),
                    ),
                    'interna-pages' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ),
                            'defaults' => array(
                                'controller' => 'cliente-controller-index',
                                'action' => 'index',
                                'id' => 1
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Cliente' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);
