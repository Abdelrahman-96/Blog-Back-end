<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlog;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request){
        $parPage = $request->pare_page ?? 3; 
        $items = Blog::paginate($parPage);
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
        $blog = Blog::find($id);
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

        $blog = Blog::create($request->all());
        $blog->addMedia($request->media)->toMediaCollection('images');
        return message(true, [],'Blog created successfully');
    }
}
