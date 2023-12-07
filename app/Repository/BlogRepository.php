<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogRepository extends BaseRepository
{

    /**
     * Use save data into Model
     *
     * @param  Request $request
     * @param  Int $id
     * @return Boolean
     */
    public function save(Request $request, $id = null)
    {
        // check weather is there id or not
        if($id){
            // if there is id use the model as the id model object
            $blog = $this->update($request->all(), $id);
        }else{
            $blog = $this->create($request->all());
        }
        return $blog;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Blog::class;
    }
}