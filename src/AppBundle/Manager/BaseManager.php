<?php

namespace AppBundle\Manager;

use AppBundle\Repository\BaseRepository;

class BaseManager
{
    /**
     * @var BaseRepository
     */
    protected $repo;

    /**
     * @param BaseRepository $repo
     */
    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  $model
     *
     * @return bool
     */
    public function create($model)
    {
        return $this->repo->create($model);
    }

    /**
     * @param CrudModel $model
     *
     * @return bool
     */
    public function update($model)
    {
        return $this->repo->save($model);
    }

    /**
     * @param CrudModel $model
     *
     * @return bool
     */
    public function delete($model)
    {
        return $this->repo->delete($model);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function getOneById($id)
    {
        return $this->repo->findOneById($id);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->repo->all();
    }

    /**
     * @param  $array
     *
     * @return bool
     */
    public function createEntities($array)
    {
        return $this->repo->createEntities($array);
    }
}
