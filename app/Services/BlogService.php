<?php

namespace App\Services;

use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class BlogService
{
    private $repo;

    /**
     * Create a new Repository instance.
     *
     * @param  TaskRepository  $repository
     * @return void
     */
    public function __construct(BlogRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Use save data into Model
     *
     * @param  Request $request
     * @param  Int $id
     * @return Boolean
     */
    public function save(Request $request, $id = null)
    {
        $blog = $this->repo->save($request, $id);
        return $blog;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id)
    {
        $blog = $this->repo->find($id);
        return $blog;
    }

    /**
     * Delete model record for given id
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function delete($id)
    {
        $blog = $this->repo->delete($id);
        return $blog;
    }

    /**
     * Get model record 
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function get(Request $request, $parePage = null)
    {
        $blog = $this->repo->get($request, $parePage);
        return $blog;
    }

}