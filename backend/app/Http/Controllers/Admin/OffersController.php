<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashBack;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Response;

class OffersController extends Controller
{

    private $logos_folder_name = "companies_logo";

    /**
     * Display a listing of the resource.
     *
     * @param null $category
     * @return Response
     */
    public function index($category = null)
    {
        return view("admin.offers.index",[
            'title' => trans("offers.title"),
            'create' => admin_url("offers/create"),
            'offers' => $category
                ? Category::with("offers")->find($category)->offers
                : Offer::with("category")->with("cashBack")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.offers.create",[
            'title' => trans("offers.create_title"),
            'categories'=> old("category_id")
                ? Category::where("id","!=",old("category_id"))->get()
                : Category::all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'company_name' => 'required',
            'company_logo' => 'sometimes|nullable',
            'about_store' => 'sometimes|nullable',
            'exceptions' => 'sometimes|nullable',
            'vip_reward' => 'required',
            'reward' => 'sometimes|nullable',
            'coupon_code' => 'sometimes|nullable',
            'category_id' => 'sometimes|nullable'
        ]);
        $data['company_logo'] = image("company_logo",false,null,$this->logos_folder_name);
        return  Offer::create($data)
            ? back()->with("success",trans("offers.success_create"))
            : back()->with("error",trans("offers.error"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if ($offer = Offer::with("Category")->with("cashBack")->find($id)) {
            return view("admin.offers.update", [
                'title' => trans("offers.update_title"),
                'offer' => $offer,
                'categories' => old("category_id")
                    ? Category::where("id", "!=", $offer->category_id)->where("id", "!=", old("category_id"))->get()
                    : Category::where("id", "!=", $offer->category_id)->get(),
                'cash_backs' => CashBack::where("offer_id",$id)->get()
            ]);
        }
        return redirect(admin_url("offers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update( $id)
    {
        if ($offer = Offer::with("Category")->with("cashBack")->find($id)) {
            $data = $this->validate(request(),[
                'company_name' => 'required',
                'company_logo' => 'sometimes|nullable',
                'about_store' => 'sometimes|nullable',
                'exceptions' => 'sometimes|nullable',
                'vip_reward' => 'required',
                'reward' => 'sometimes|nullable',
                'coupon_code' => 'sometimes|nullable',
                'category_id' => 'sometimes|nullable'
            ]);
            $data['company_logo'] = image("company_logo",false,$offer->company_logo,$this->logos_folder_name);
            return  $offer->update($data)
                ? back()->with("success",trans("offers.success_update"))
                : back()->with("error",trans("offers.error"));
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($offer = Offer::find($id)) {
            $offer->delete();
            return json(null,1,trans("offers.success_delete"));
        }
        return json(null,0,trans("offers.error"));
    }

}
