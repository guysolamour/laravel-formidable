<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\DynamicForm;
use Illuminate\Http\Request;
// use Guysolamour\Administrable\Http\Controllers\BaseController;

class FormidableController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = DynamicForm::latest()->get();

        return view('back.formidable.index', compact('forms'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.formidable.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'  => 'required|string',
            'fields' => 'required',
            'active' => 'required|in:0,1',
        ]);

        DynamicForm::create([
            'title'  => $data['title'],
            'fields' => $data['fields'],
            'active' => $data['active'],
        ]);

        flashy("Le formulaire a bien été enregistré");

        return redirect()->route('back.formidable.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show(string $url)
    {
        $form = DynamicForm::findByUrl($url)->first();

       return view('back.formidable.show', compact('form'));
    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(string $url)
    {
        $form = DynamicForm::findByUrl($url)->first();

        return view('back.formidable.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $url)
    {
        $data = $request->validate([
            'title'  => 'required|string',
            'fields' => 'required',
            'active' => 'required|in:0,1',
        ]);

        /**  @var DynamicForm */
        $form = DynamicForm::findByUrl($url)->first();

        $form->update([
            'title'  => $data['title'],
            'fields' => $data['fields'],
            'active' => $data['active'],
        ]);

        flashy('Le formulaire a bien été modifié');

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $url)
    {
        /**  @var DynamicForm */
        $form = DynamicForm::findByUrl($url)->first();
        $form->delete();

        flashy('Le formulaire a bien été supprimé');

        return redirect()->route('back.formidable.index');
    }

    public function removeEntry(string $url, int $id)
    {
       /**  @var DynamicForm */
       $form = DynamicForm::findByUrl($url)->first();
       $form->removeEntry($id);

       flashy('L\' élement a bien été supprimé');

        return back();
    }

}
