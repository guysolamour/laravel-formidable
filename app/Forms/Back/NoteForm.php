<?php

namespace App\Forms\Back;

use Kris\LaravelFormBuilder\Form;

class NoteForm extends Form
{
    public function buildForm()
    {
        if ( $this->getModel() && $this->getModel()->getKey() ) {
          $method = 'PUT';
          $url    = route( 'back.note.update', $this->getModel() );
        } else {
          $method = 'POST';
          $url    = route( 'back.note.store' );
        }

        $this->formOptions = [
          'method' => $method,
          'url'    => $url,
          'name'   => get_form_name($this->getModel()),
        ];

        $this
            // add fields here

            ->add('online', 'select', [
                'label'   => 'En ligne',
                'choices' => ['1' => 'Yes', '0' => 'No'],
                'rules'   => 'required|in:0,1',
            ])    
            ->add('title', 'text', [
                'label'  => 'Titre',
                
                
                'attr' => [
                    
                    
                ],

            ])    
            ->add('description', 'textarea', [
                'label'  => 'Description',
                
                'rules' => ['required',],
                'attr' => [
                    'data-tinymce',
                    
                ],

            ])


        ;

    }
}
