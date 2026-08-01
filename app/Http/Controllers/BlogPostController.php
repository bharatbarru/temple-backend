<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogPostController extends AppBaseController
{
    /** @var BlogPostRepository $blogPostRepository*/
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepo)
    {
        $this->blogPostRepository = $blogPostRepo;

        $this->middleware('role_or_permission:add-blog_posts', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-blog_posts', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-blog_posts', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-blog_posts', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the BlogPost.
     */
    public function index(Request $request)
    {
        return view('blog_posts.index');
    }

    /**
     * Show the form for creating a new BlogPost.
     */
    public function create()
    {
        $categories = BlogCategory::all()->pluck('name', 'id');
        session()->put('previous_url', url()->previous());
        return view('blog_posts.create', compact('categories'));
    }

    /**
     * Store a newly created BlogPost in storage.
     */
    public function store(CreateBlogPostRequest $request)
    {
        $input = $request->all();

        $blogPost = $this->blogPostRepository->create($input);
        
        if ($request->hasfile('image')) {
            $blogPost->image = uploadImage($request->file('image'), BLOG_POST_IMAGE_PATH);
        }
        if ($request->hasfile('author_image')) {
            $blogPost->author_image = uploadImage($request->file('author_image'), BLOG_POST_IMAGE_PATH);
        }
        
        $blogPost->image_gallery = uploadMultipleImage($request->file('image_gallery'), BLOG_POST_IMAGE_PATH, $request->multiple_alt_textgallery, null);
        $blogPost->save();


        Flash::success('Blog Post saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('blogPosts.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified BlogPost.
     */
    public function show($id)
    {
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            Flash::error('Blog Post not found');

            return redirect()->back();
        }

        return view('blog_posts.show')->with('blogPost', $blogPost);
    }

    /**
     * Show the form for editing the specified BlogPost.
     */
    public function edit($id)
    {
        $categories = BlogCategory::all()->pluck('name', 'id');
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            Flash::error('Blog Post not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('blog_posts.edit', compact('categories', 'blogPost'));
    }

    /**
     * Update the specified BlogPost in storage.
     */
    public function update($id, UpdateBlogPostRequest $request)
    {
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            Flash::error('Blog Post not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($blogPost->image, BLOG_POST_IMAGE_PATH);
        }
        if ($request->hasfile('author_image')) {
            removeImage($blogPost->author_image, BLOG_POST_IMAGE_PATH);
        } 

        $fieldsToUpdate = $request->except('image_gallery');

        $blogPost = $this->blogPostRepository->update($fieldsToUpdate, $id);
        if ($request->hasfile('image')) {
            $blogPost->image = uploadImage($request->file('image'), BLOG_POST_IMAGE_PATH);
        }
        if ($request->hasfile('author_image')) {
            $blogPost->author_image = uploadImage($request->file('author_image'), BLOG_POST_IMAGE_PATH);
        }
        $blogPost->image_gallery = uploadMultipleImage($request->file('image_gallery'), BLOG_POST_IMAGE_PATH, $request->multiple_alt_textgallery, $blogPost->image_gallery);
        $blogPost->save();

        Flash::success('Blog Post updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('blogPosts.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified BlogPost from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $blogPost = $this->blogPostRepository->find($id);

        if (empty($blogPost)) {
            Flash::error('Blog Post not found');

            return redirect()->back();
        }

        if ($blogPost->image  != '') {
            removeImage($blogPost->image, BLOG_POST_IMAGE_PATH);
        }
        if ($blogPost->author_image  != '') {
            removeImage($blogPost->author_image, BLOG_POST_IMAGE_PATH);
        }

        
        if ($blogPost->image_gallery != '') {
            foreach (json_decode($blogPost->image_gallery, true) as $gal) {
                removeImage($gal['path'], BLOG_POST_IMAGE_PATH);
            }
        }

    try{
        $this->blogPostRepository->delete($id);
    }
     catch (\Illuminate\Database\QueryException $e) {
        return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
    }

        Flash::success('Blog Post deleted successfully.');

        return redirect()->back();
    }

    public function removeGalleryItem($id, $key)
    {
        $blogpost = BlogPost::find($id);
        if (!empty($service)) {
            $data = json_decode($blogpost->image_gallery, true);
            removeImage($data[$key]['path'], BLOG_POST_IMAGE_PATH);
            unset($data[$key]);
            $blogpost->image_gallery = json_encode(array_values($data));
            $blogpost->save();
            Flash::success('Image Removed Successfully.');
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}