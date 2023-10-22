<?php

namespace App\Http\Controllers;

use App\Enums\StatusCode;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    protected $blogRepository;
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    public function index(){
        return view('user.story.index');
    }

    public function getBlogs(){
        return $this->blogRepository->getBlogs();
    }

    public function getBlogLatest(){
        return $this->blogRepository->getBlogLatest();
    }

    public function getBlogView(){
        return $this->blogRepository->getBlogView();
    }

    public function show($id){
        $story = $this->blogRepository->find($id);
        if($story){
            return view('user.story.show');
        }
        abort(StatusCode::NOT_FOUND);
    }

    public function detailBlog($id){
        $story = $this->blogRepository->find($id);
        return $story;
    }
}
