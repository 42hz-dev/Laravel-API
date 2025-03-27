<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PostController extends Controller
{
    // add a post
    public function addNewPost(Request $request): JsonResponse|null
    {
        $attributes = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Posts added successfully',
            'post' => $post
        ], 200);
    }

    // edit a post
    public function editPost(Request $request, Post $post): JsonResponse|null
    {

        $attributes = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post->update($attributes);

        return response()->json([
            'message' => 'Posts updated successfully',
            'updated_post' => $post
        ], 200);
    }

    // retrieve all posts
    public function getAllPosts(): JsonResponse|null
    {
        $posts = Post::all();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    // retrieve post
    public function getPost(Post $post): JsonResponse|null
    {
        return response()->json([
            'post' => $post
        ], 200);
    }
}
