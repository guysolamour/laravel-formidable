<?php

namespace App\Http\Controllers\Back;

use App\Models\Note;
use Illuminate\Http\Request;
use Guysolamour\Administrable\Http\Controllers\BaseController;
use App\Forms\Back\NoteForm;
use Guysolamour\Administrable\Traits\FormBuilderTrait;

class NoteController extends BaseController
{
    use FormBuilderTrait;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::last()->get();
        return view('back.notes.index', compact('notes'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->getForm(new Note, NoteForm::class);

        return view('back.notes.create', compact('form'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $form = $this->getForm(new Note, NoteForm::class);

       $form->redirectIfNotValid();

       Note::create($request->all());

       flashy('L\' élément a bien été ajouté');

       return redirect()->route('back.note.index');
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
    public function edit(Note $note)
    {
        $form = $this->getForm($note, NoteForm::class);
        return view('back.notes.edit', compact('note','form'));
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
