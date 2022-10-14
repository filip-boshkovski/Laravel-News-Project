<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        foreach($request->categories as $key => $id) {
            DB::table('post_category')->insert([
              'post_id' => $post->id,
              'category_id' => $id  
            ]);
        }

        $tags = explode(', ', $request->tags);
        foreach($tags as $key => $tagName) {

            DB::table('tags')->updateOrInsert([
                'name' => $tagName
            ]);

            $tag = Tag::where(['name' => $tagName])->first();

            DB::table('post_tag')->insert([
                'post_id' => $post->id,
                'tag_id' => $tag->id
            ]);

        }

        return redirect('/post/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.post.show', [
            'post' => Post::with('comments', 'categories')->findOrFail($id),
            'posts' => Post::limit(3)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function singlePost($id) 
    {
        $post = Post::with('comments', 'categories', 'tags')->findOrFail($id);

        $tags = $post->tags;

        $tagIds = $tags->pluck('id');

        $postsIds = DB::table('posts')
                    ->select(DB::raw('DISTINCT(posts.id)'))
                    ->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
                    ->whereIn('post_tag.tag_id', $tagIds)
                    ->whereNotIn('post_tag.post_id', [$post->id])
                    ->get();

        $posts = Post::whereIn('id', $postsIds->pluck('id'))->limit(3)->inRandomOrder()->get();


        return view('singlePost', [
            'post' => $post,
            'posts' => $posts
        ]);
    }

    public function apiGetPosts()
    {
        return response()->json(['data' => PostResource::collection(Post::all())]);
    }

    public function apiStorePost(StorePostRequest $request) 
    {

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        $tags = explode(', ', $request->tags);
        foreach($tags as $key => $tagName) {

            DB::table('tags')->updateOrInsert([
                'name' => $tagName
            ]);

            $tag = Tag::where(['name' => $tagName])->first();

            DB::table('post_tag')->insert([
                'post_id' => $post->id,
                'tag_id' => $tag->id
            ]);

        }

        return response()->json([
                            'data' => [
                                'post' => new PostResource($post)
                            ],
                            'message' => 'Post inserted'
                            ], 200);

    }
}
