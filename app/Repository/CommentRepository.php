<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository extends BaseRepository
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
            $comment = $this->update($request->all(), $id);
        }else{
            $comment = $this->create($request->all());
        }
        return $comment;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Comment::class;
    }
}