<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    
    public function index()
    {
        return Post::all();
    }


    public function show($id)
    {

        try 
        {
            return Post::findOrFail($id);
        }

        catch  (ModelNotFoundException $ex)
        {
           return response()->json(['message' => 'Post not Found'], 404);
       }
    
    }


    public function store()
    {
        $request = Request::capture();
        $raw = $request->json();
        $body = $raw->all();
        $project = Project::create($body);
        if ($project) {
            return response($project->id, 201);
        }
        return response("Could not create Project. Malformed Request?", 400);
    }
}
