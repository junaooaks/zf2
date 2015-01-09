<?php

namespace Cliente\Entity;

use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository {

    public function pesquisa($str) {
        return $this->createQueryBuilder('c')
                        ->where('c.nome LIKE :param')
                        ->setParameter('param', '%' . $str . '%')
                        ->getQuery()
                        ->getResult();
    }

    //put your code here
}
