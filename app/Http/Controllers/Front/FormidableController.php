<?php

namespace App\Http\Controllers\Front;

use App\Models\DynamicForm;
use Illuminate\Http\Request;
use App\Models\DynamicFormField;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

// use Guysolamour\Administrable\Http\Controllers\BaseController;

class FormidableController extends Controller
{



     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $url = $request->query('url');
        /**  @var DynamicForm */
        $form = DynamicForm::findByUrl($url)->firstOrFail();


        return view('front.formidable.show', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $url, Request $request)
    {
        // pour la validation recuperer le formulaire et appliquer dynamiquement les regles
        $form = DynamicForm::findByUrl($url)->first();

        $request->validate($form->getRules());

        $form->saveEntries($request->all());


        flashy("Le formulaire a bien été enregistré");

        return back();
    }

}
