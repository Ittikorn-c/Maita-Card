<?php

namespace App\Http\Controllers;

use App\CardTemplate;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CardTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        if(Gate::denies("view-shop", $shop))
            return redirect("profile/".\Auth::user()->id);

        $templates = $shop->cardTemplates;
        
        return view("owner.templates.index", compact("shop", "templates"));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($shop_id)
    {
        $style = [
            "stamp", "point"
        ];
        $shops = \App\Shop::shopOwner(\Auth::user()->id)->get();
        return view("owner.templates.create", compact("style", "shop_id", "shops"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $template = new CardTemplate;
            $template->name = $request->input("name");
            $template->style = $request->input("style");
            $template->shop_id = $request->input("shop");
            $template->img = "";
            $template->save();
            $image_name = $template->id . "." . $request->img->extension();
            \Storage::disk('public')->put("cards/$image_name", file_get_contents($request->file("img")));
            $template->img = $image_name;
            $template->save();
            return redirect("/templates/shop/$template->shop_id");
        } catch (\Exception $e) {
            return back()->withInput();
        }
    }

    
    public function show($template_id)
    {
        $cardTemplate = CardTemplate::findOrFail($template_id);
        return view("owner.templates.show", ["template"=>$cardTemplate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardTemplate  $cardTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit($template_id)
    {
        $style = [
            "stamp", "point"
        ];
        $shops = \App\Shop::shopOwner(\Auth::user()->id)->get();
        $template = CardTemplate::findOrFail($template_id);
        return view("owner.templates.edit", compact("style", "template", "shops"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardTemplate  $cardTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $template_id)
    {
        $template = CardTemplate::findOrFail($template_id);
        try {
            $template->name = $request->input("name");
            $template->style = $request->input("style");
            $template->shop_id = $request->input("shop");
            $template->img = "";
            $template->save();
            if($request->img){
                $image_name = $template->id . "." . $request->img->extension();
                \Storage::disk('public')->put("cards/$image_name", file_get_contents($request->file("img")));
                $template->img = $image_name;
                $template->save();
            }
            return redirect("/templates/shop/$template->shop_id");
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardTemplate  $cardTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($template_id)
    {
        $template = CardTemplate::findOrFail($template_id);
        $shop_id = $template->shop_id;
        $template->delete();
        return redirect("/templates/shop/$shop_id");
    }
}
