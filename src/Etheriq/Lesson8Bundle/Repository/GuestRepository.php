<?php
/**
 * Created by PhpStorm.
 * File: GuestRepository.php
 * User: Yuriy Tarnavskiy
 * Date: 01.12.13
 * Time: 17:04
 * To change this template use File | Settings | File Templates.
 */

namespace Etheriq\Lesson8Bundle\Repository;

use Doctrine\ORM\EntityRepository;

class GuestRepository extends EntityRepository
{
    public function findDESCGuests()
    {

     return $this->getEntityManager()
                ->createQuery(
                'SELECT g FROM EtheriqLesson8Bundle:Guest g ORDER BY g.id DESC'
                );
    }

    public function findAllGuests()
    {

        return $this->getEntityManager()
            ->createQuery(
                'SELECT g FROM EtheriqLesson8Bundle:Guest g'
            );
    }
} 