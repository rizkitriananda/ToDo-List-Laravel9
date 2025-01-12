<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index($categoryName)
    {
        $category = [
            'posts' =>  Post::where([['user_id', auth()->user()->id], ['category', $categoryName]])->orderBy('id', 'desc')->get(),
            'title' => $categoryName
        ];

        if ($categoryName == 'All') {
            $category['posts'] =  Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        }

        return view('category', $category);
    }

    public function destroy($postId)
    {
        Post::destroy($postId);
        return redirect('/categories/All')->with('success', 'Post has been deleted.');
    }
}
