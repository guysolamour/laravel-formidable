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

        // $form = $forms->first();

        // dd($form->fields);


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
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
       return view('back.notes.show', compact('note'));
    }



      /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(string $url)
    {
        $form = DynamicForm::findByUrl($url)->first();
        // dd($form->full_url);
        return view('back.formidable.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $form = $this->getForm($note, NoteForm::class);
        $form->redirectIfNotValid();
        $note->update($request->all());

        flashy('L\' élément a bien été modifié');

        return redirect()->route('back.note.index');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        flashy('L\' élément a bien été supprimé');

        return redirect()->route('back.note.index');
    }




    


}
