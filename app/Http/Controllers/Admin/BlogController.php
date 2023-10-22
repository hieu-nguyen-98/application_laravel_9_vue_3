<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BlogStatus;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Exception\BadRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    protected $blogRepository;
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    public function index(){
        return view('admin.blogs.index');
    }

    public function getBlogs(){
        $query = request('query');
        $blogs = $this->blogRepository->all($query);
        
        return $blogs;
    }

    public function create(){
        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAndReturnImageUrl($request->file('image'));
        }
        $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
        $data['user_id'] = Auth::user()->id;
        $data['view'] = BlogStatus::ZERO;
        $blog = $this->blogRepository->create($data);
        return response()->json(['message' => 'Blog created successfully!']);
    }

    protected function uploadAndReturnImageUrl($image)
    {
        try {
            if ($image->isValid()) {
                $uploadedFile = Cloudinary::upload($image->getRealPath(), [
                    'upload_preset' => 'my-custom-preset',
                ]);
                return $uploadedFile->getSecurePath();
            } else {
                return null; 
            }
        } catch (BadRequest $e) {
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function edit($id){
        $blog = $this->blogRepository->find($id);
        if($blog){
            return view('admin.blogs.edit');
        };
        abort(StatusCode::NOT_FOUND);
    }

    public function editData(Blog $blog){
        return $blog;
    }

    public function update(UpdateBlogRequest $request, $id){

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadAndReturnImageUrl($request->file('image'));
        }
        $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
        $blog = $this->blogRepository->update($id, $data);
        return response()->json(['message' => 'Blog updated successfully!']);
    }

    public function destroy($id){

        $blog = $this->blogRepository->delete($id);
        if($blog){
            return response()->json('message','something went wrong!');
        }

        return response()->json(['success' => true], StatusCode::OK);
    }

    public function MultipleDelete(Request $request)
    {
        $ids = $request->ids; 

        if (!empty($ids)) { 
            $this->blogRepository->mulDelete($ids);
            return response()->json(['message' => 'Blogs deleted successfully!']);
        }

        return response()->json(['message' => 'No Blogs to delete.']);
    }
}
