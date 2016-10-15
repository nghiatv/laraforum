<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
class SiteController extends Controller
{
    //
    public function index(){
        $data =Post::orderBy('created_at','desc')->paginate(6);
        return view('sites.index',compact('data'));
    }
    public function show($id){
        $data = Post::find($id);

        return view('sites.detail',compact('data'));
    }

    public function listCategories(){
        $data = Category::paginate(6);
        return view('sites.list-category',compact('data'));
    }
    public function showCategory($id){

        if(Category::findOrFail($id)){
            $data = Post::where('category_id',$id)->orderBy('created_at','desc')->paginate(6);
            $category = Category::find($id);
            return view('sites.show-category',compact('data'))->with([
                'category' => $category
            ]);
        }
        else{
            abort(404);
        }

    }
}
