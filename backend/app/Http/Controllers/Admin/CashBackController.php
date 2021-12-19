<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashBack;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;

class CashBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.offers.index",[
            'title' => trans("cashBack.Title"),
            'create' => admin_url("cash-back/create"),
            'offers' => Offer::with("category")->with("cashBack")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cash_back.create",[
            'title' => trans("offers.cash_back_create_title"),
            'offers' => old("offer_id") ? Offer::where("id","!=",old("offer_id"))->get() : Offer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $rules = [
            'title' => "required",
            'vip_reward' => "sometimes|nullable",
            'reward' => "required",
            'offer_id' => "required|integer",
        ];
        if (request()->ajax()){

            $data = Validator::make(request()->all(),$rules);
            if ($data->fails())
                return json(["errors" => $data->errors()->all()],500,null);

            return ($create = CashBack::create(request()->all()))
                ? json(['id' =>$create->id ],200,trans("cashBack.Create_Success"))
                : json(null, 500, trans("cashBack.Error"));
        }
        $data = $this->validate(request(), $rules);
        return CashBack::create($data)
            ? back()->with("success", trans("offers.cash_back_success_create"))
            : back()->with("error", trans("offers.error"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($cash_back = CashBack::with("offer")->find($id)){
            return view("admin.cash_back.update",[
                'title' => trans("cashBack.Create_Title"),
                'cash_back' => $cash_back,
                'offers' => Offer::where("id","!=",$cash_back->offer_id)->get(),
            ]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id)
    {
        if ($cash_back = CashBack::with("offer")->find($id)){
            $data = $this->validate(request(),[
                'title' => "required",
                'vip_reward' => "sometimes|nullable",
                'reward' => "required",
                'offer_id' => "required|integer",
            ]);
            return $cash_back->update($data)
                ? back()->with("success", trans("offers.cash_back_success_update"))
                : back()->with("error",trans("offers.error"));
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($cash_back = CashBack::find($id)) {
            $cash_back->delete();
            return json(null,1,trans("offers.cash_back_delete_success"));
        }
        return json(null,0,trans("offers.error"));
    }

}
