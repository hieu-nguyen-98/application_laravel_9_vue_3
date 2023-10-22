<?php
namespace App\Repositories;

use App\Enums\BlogStatus;
use App\Enums\TypePaginate;
use App\Models\Blog;

class BlogRepository implements BaseRepositoryInterface
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function all()
    {
        $perPage = TypePaginate::TEN;
        return $this->blog->query()
        ->when(request('query'), function ($query, $searchQuery) {
            $query->where('meta_title', 'like', "%{$searchQuery}%");
        })
        ->latest()
        ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->blog->find($id);
    }

    public function create(array $data)
    {
        return $this->blog->create($data);
    }

    public function update($id, array $data)
    {
        $blog = $this->blog->find($id);
        $blog->update($data);
        return $blog;
    }

    public function delete($id)
    {
        $blog = $this->blog->find($id);
        $blog->delete();
    }

    public function mulDelete($ids){
        return $this->blog->whereIn('id', $ids)->delete();
    }

    public function getBlogs(){
        $postsPerPage = TypePaginate::FIVE;
        return $this->blog->paginate($postsPerPage);
    }

    public function getBlogLatest(){
        return $this->blog->latest('created_at')->limit(BlogStatus::LATEST)->get();
    }

    public function getBlogView(){
        return $this->blog->orderBy('view', 'desc')->limit(BlogStatus::LATEST)->get();
    }
}