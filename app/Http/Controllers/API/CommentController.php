<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateComment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $service;

    /**
     * [Make Setup For using Comments Actions]
     *
     * @param  CommentService  $service
     * @return void
     */
    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function store(CreateComment $request) {
        $request->merge([
            'user_id' => user()->id
        ]);
        $this->service->save($request); 
        return message(true, [],'Comment created successfully');
    }

    public function update(Request $request, $id) {
        if(!$id){
            return message(false, [],'This comment not found');
        }
        $comment = $this->service->find($id);
        if(user()->id != $comment->user_id){
            return message(false, [],'You cant take this action');
        }
        if(!$comment){
            return message(false, [],'This comment not found');
        }

        $this->service->save($request, $id); 
        return message(true, [],'Comment updated successfully');
    }

    public function delete($id) {
        if(!$id){
            return message(false, [],'This comment not found');
        }
        $comment = $this->service->find($id);
        if(user()->id != $comment->user_id){
            return message(false, [],'You cant take this action');
        }
        if(!$comment){
            return message(false, [],'This comment not found');
        }
        $this->service->delete($id); 

        return message(true, [],'Comment deleted successfully');
    }
}
