<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("admin.categories.index", [
            'title' => trans("categories.title"),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.categories.create",[
            'title' => trans("categories.create"),
            'categories' => old("subchild") ? Category::where("id","!=",old("subchild"))->get() : Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     * @throws ValidationException
     */
    public function store()
    {

        Category::create($this->validate(request(),[
            'name' => 'required|string|unique:categories',
            'name_ar' => 'required|string|unique:categories',
            'link' => 'sometimes|nullable',
            'subchild' => 'sometimes|nullable',
            'details' => 'sometimes|nullable|string',
        ],[],[
            'name' => trans("categories.name"),
            'name_ar' => trans("categories.name_AR"),
            'subchild' => trans("categories.sub"),
            'details' => trans("categories.details"),
        ]));

        return redirect(admin_url("categories/create"))->with("success",trans("categories.create_success"));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return redirect(admin_url("categories"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if ($category = Category::find($id)) {
            return view("admin.categories.update", [
                'title' => trans("categories.edit_title"),
                'category' => $category,
                'categories' => old("subchild")
                    ? Category::where("id","!=",old("subchild"))->where("id", "!=", $category->subchild)->get()
                    : Category::where("id", "!=", $category->subchild)
            ]);
        }
        return redirect(admin_url("categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update( $id)
    {
        if ($category = Category::find($id)) {
            return $category->update($this->validate(request(), [
                'name' => 'required|string|unique:categories,name,'. $id,
                'name_ar' => 'required|string|unique:categories,name_ar,' .$id ,
                'subchild' => 'sometimes|nullable',
                'details' => 'sometimes|nullable|string',
            ], [], [
                'name' => trans("categories.name"),
                'name_ar' => trans("categories.name_ar"),
                'subchild' => trans("categories.Sub"),
                'details' => trans("categories.details"),
            ]))
                ? back()->with("success",trans("categories.success_update"))
                : back()->with("info",trans("categories.update_info"));
        }
        return redirect(admin_url("categories"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        if ($category = Category::find($id)) {
            $category->delete();
            return json(null,1,trans("categories.success_delete"));
        }
        return json(null,0,trans("categories.error_delete"));
    }


}
