<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Post\IndexPost;
use App\Http\Requests\Admin\Post\StorePost;
use App\Http\Requests\Admin\Post\UpdatePost;
use App\Http\Requests\Admin\Post\DestroyPost;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Post;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPost $request
     * @return Response|array
     */
    public function index(IndexPost $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Post::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'published_at', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'slug', 'perex']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.post.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.post.create');

        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePost $request
     * @return Response|array
     */
    public function store(StorePost $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Post
        $post = Post::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/posts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        $this->authorize('admin.post.show', $post);
       // return view('welcome', compact('post'));
        

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $this->authorize('admin.post.edit', $post);

        return view('admin.post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePost $request
     * @param  Post $post
     * @return Response|array
     */
    public function update(UpdatePost $request, Post $post)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Post
        $post->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/posts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyPost $request
     * @param  Post $post
     * @return Response|bool
     */
    public function destroy(DestroyPost $request, Post $post)
    {
        $post->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    public function all()
    {
        $posts = Post::latest()->get();     
        return view('welcome',compact('posts'));
    }
}
