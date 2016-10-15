<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Post::all();

        return view('posts.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $rules = [
            'title' => 'required|min:10',
            'content' => 'required|min:20',
            'category' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            alert()->error($validation->getMessageBag()->all(), 'Lỗi')->persistent('Close');
            return redirect()->back();
        }

        $post = new Post();


        $post->title = $request->input('title');
        $post->slug = str_slug($request->input('title'));
        $post->body = $request->input('content');
        $post->author_id = $request->user()->id;
        $post->active = 1;
        $post->category_id = $request->input('category');


        if ($request->file('banner')) {
            $extension = $request->file('banner')->getClientOriginalExtension();

            $filename = uniqid() . '_banner.' . $extension;


            if ($request->file('banner')->move('img/', $filename)) {
                $post->banner = url('img/' . $filename);
            }
        }

        $post->save();
        alert()->success('Tạo mới thành công', 'Thành Công');
        return redirect(url('/admin/posts/'.$post->id.'/edit')); // to do
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::find($id);
        $categories = Category::all();
        return view('posts.edit')->with([
            'data' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|min:10',
            'content' => 'required|min:20',
            'category' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            alert()->error($validation->getMessageBag()->all(), 'Lỗi')->persistent('Close');
            return redirect()->back();
        }

        $post = Post::find($id);


        $post->title = $request->input('title');
        $post->slug = str_slug($request->input('title'));
        $post->body = $request->input('content');
        $post->category_id = $request->input('category');


        if ($request->file('banner')) {
            $extension = $request->file('banner')->getClientOriginalExtension();

            $filename = uniqid() . '_banner.' . $extension;


            if ($request->file('banner')->move('img/', $filename)) {
                $post->banner = url('img/' . $filename);
            }
        }

        $post->save();
        alert()->success('Sua thành công', 'Thành Công');
        return redirect()->back(); // to do
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage(Request $request)
    {
        $rules = [
            'file' => 'required|image|mimes:jpeg,jpg,png,gif'
        ];


        $data = $request->all();
//        dd($data['file']);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 'invalid file type']);
        }
//        dd($request->file('file'));
        if ($request->file('file')) {
            $extension = $request->file('file')->getClientOriginalExtension();

            $filename = uniqid() . '_attachment.' . $extension;
            if ($request->file('file')->move('img/post/', $filename)) {
                return response()->json(['data' => url('img/post/' . $filename)]);
            }

        } else {
            return '{"status":"Invalid File type"}';
        }
    }
}
