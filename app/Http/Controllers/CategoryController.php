<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Validator;
use Alert;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all();
        return view('categories.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:20'
        ];
        $messages = [
            '*.required' => ':attribute là bắt buộc',
            '*.min' => ':attribute phải ít nhất :min kí tự'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        // Neu loi thi tra ve loi cho nguoi dung
        if ($validation->fails()) {
            Alert::error($validation->getMessageBag()->all(), 'Oops') ->persistent('Close');

            return redirect()->back()->withInput();
        }

        $category = new Category();

        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->description = $request->description;

        if ($request->file('banner')) {
            $extension = $request->file('banner')->getClientOriginalExtension();

            $filename = uniqid() . '_banner.' . $extension;


            if ($request->file('banner')->move('img/', $filename)) {
                $category->image = url('img/' . $filename);
            }
        }

        $category->save();
        alert('success', 'Taọ mới thành công category!!');
//        return redirect('/admin/categories/'.$category->id);
        return redirect()->route('categories.create');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = Category::find($id);

        return view('categories.edit', compact('data'));
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
            'name' => 'required|min:3',
            'description' => 'required|min:20'
        ];
        $messages = [
            '*.required' => ':attribute là bắt buộc',
            '*.min' => ':attribute phải ít nhất :min kí tự'
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        // Neu loi thi tra ve loi cho nguoi dung
        if ($validation->fails()) {
            Alert::error($validation->getMessageBag()->all(), 'Oops') ->persistent('Close');

            return redirect()->back();
        }

        $category = Category::find($id);

        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->file('banner')) {
            $extension = $request->file('banner')->getClientOriginalExtension();

            $filename = uniqid() . '_banner.' . $extension;


            if ($request->file('banner')->move('img/', $filename)) {
                $category->image = url('img/' . $filename);
            }
        }
        $category->save();

        Alert::success('Thành công','Sửa category thành công');
        return redirect()->back();
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

        $category = Category::find($id);

        $category->delete();

        alert()->success('Thành công!!','Xóa thành công category');
        return redirect()->back();
    }
}
