<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlog;
use App\Http\Resources\BlogResource;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private $service;

    /**
     * [Make Setup For using Blogs Actions]
     *
     * @param  BlogService  $service
     * @return void
     */
    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request){
        $parPage = $request->pare_page ?? 3;
        $items = $this->service->get($request, $parPage); 
        $blogs = BlogResource::collection($items);
        $data = [
            'current_page' => $items->currentPage(),
            'total' => $items->total(),
            'count' => $items->count(),
            'per_page' => $items->perPage(),
            'total_pages' => $items->lastPage(),
            'next_page_url' =>$items->nextPageUrl(),
            'previous_page_url' =>$items->previousPageUrl(),
            'items' => $blogs
        ];
        return message(true, $data,'Blogs retrived successfully');

    }

    public function show($id){
        if(!$id){
            return 'This blog doesn\'t exist!';
        }
        $blog = $this->service->find($id); 
        if (!$blog) {
            return 'This blog doesn\'t exist!';
        }
        $blog = new BlogResource($blog);
        return message(true, $blog,'Blog retrived successfully');
    }

    public function store(CreateBlog $request){
        $request->merge([
            'user_id' => user()->id
        ]);
        $blog = $this->service->save($request); 
        $blog->addMedia($request->media)->toMediaCollection('images');
        return message(true, [],'Blog created successfully');
    }
}
