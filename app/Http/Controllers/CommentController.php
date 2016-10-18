<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentNotify;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only('store','index');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post)
    {
        //
        $rules = [
          'body' => 'required|min:5'
        ];

        $messages = [
            'body.required' => ':attribute là bắt buộc',
            'body.min' => ':attribute là tối thiểu  : min kí tự',
        ];
        $this->validate($request,$rules,$messages);
        //store the comment

        $comment = new Comment();

        $comment->on_post = $post;
        $comment->from_user = $request->user()->id;
        $comment->body = $request->body;

        $comment->save();


        $blog = Post::find($post);


        $user = $blog->user->first();


        $user->notify(new CommentNotify($blog, $comment));


        alert()->success('Bình loạn thành công');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
