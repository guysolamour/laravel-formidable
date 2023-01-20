@extends(back_view_path('layouts.base'))

@section('title', $form->title)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Ajout</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.formidable.index') }}">Formulaires</a></li>
                            <li class="breadcrumb-item active">{{ $form->title }}</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Réduire">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class='col-md-12'>
                        <section style="margin-bottom: 2rem;" class="d-flex justify-content-end">
                            <div class="btn-group-horizontal">
                                <a href="{{ route('back.formidable.edit', $form) }}" class="btn btn-info" data-toggle="tooltip"
                                    data-placement="top" title="Editer"><i class="fas fa-edit"></i>Editer</a>


                                <a href="{{ route('back.formidable.delete',$form) }}" data-method="delete" data-toggle="tooltip"
                                    data-placement="top" title="Supprimer"
                                    data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?" class="btn btn-danger"><i
                                        class="fa fa-trash"></i> Supprimer</a>


                            </div>
                        </section>

                        <p class="pb-2"><b>Titre: </b>{{ $form->title }}</p>
                        <p class="pb-2"><b>Active: </b>{{ $form->online ? __('Yes') : __('No') }}</p>
                        <p class="pb-2"><b>Champs: </b>
                        @foreach ($form->getFields(false) as $field)
                            <span class="badge badge-warning p-2">{{ $field->label }}</span>
                        @endforeach
                        </p>
                        <p class="pb-2"><b>Date ajout: </b>{{ format_date($form->created_at) }}</p>


                        <button class="btn btn-secondary btn-block text-center font-weight-bold" type="button" data-toggle="collapse" data-target="#collapseEntries" aria-expanded="false" aria-controls="collapseEntries">
                            Entries ({{ $form->entries?->count() ?? 0 }})
                          </button>

                        </p>
                        <div class="collapse" id="collapseEntries">
                          <div class="card card-body">
                            <table class="table table-hover table-striped" id="list">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    @foreach ($form->getFields(false)->pluck('label') as $label)
                                    <th scope="col">{{ $label }}</th>
                                    @endforeach
                                    <th scope="col">Date création</th>
                                    <th scope="col">Options</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($form->entries as $entries)
                                    <tr>

                                        @foreach ($entries as $entry)
                                            <td>{{ $entry }}</td>
                                        @endforeach
                                        <td>
                                            <div class="btn-group" role="group">
                                                {{-- <a href="{{ route('back.note.show', $note) }}"
                                                 class="btn btn-primary" data-toggle="tooltip"
                                                 data-placement="top" title="Afficher"><i
                                                     class="fas fa-eye"></i></a>


                                                <a href="{{ route('back.note.edit', $note) }}"
                                                    class="btn btn-info" data-toggle="tooltip"
                                                    data-placement="top" title="Editer"><i
                                                        class="fas fa-edit"></i></a> --}}

                                                <a href="{{ route('back.formidable.entries.delete', [$form, Arr::first($entries)]) }}"
                                                    data-method="delete"
                                                    data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?"
                                                    class="btn btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Supprimer"><i
                                                    class="fas fa-trash"></i>
                                                </a>

                                         </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
