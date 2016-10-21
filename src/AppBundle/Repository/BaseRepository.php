<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function create($model, $autoFlush = true)
    {
        return $this->insert($model, $autoFlush);
    }

    public function save($model, $autoFlush = true)
    {
        return $this->insert($model, $autoFlush);
    }

    public function delete($model)
    {
        try {
            $this->getEntityManager()->remove($model);
            $this->getEntityManager()->flush();

            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function findOneById($id)
    {
        return $this->findOneBy(array('id' => $id));
    }

    public function all()
    {
        return $this->findAll();
    }

    private function insert($model, $autoFlush = true)
    {
        $this->getEntityManager()->persist($model);
        if ($autoFlush) {
            $this->getEntityManager()->flush();

            return true;
        }
    }

    public function createEntities($models)
    {
        foreach($models as $model) {
            $this->getEntityManager()->persist($model);
        }

        $this->getEntityManager()->flush();

        return true;
    }
}
