@extends(back_view_path('layouts.base'))

@section('title', $note->title)

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
                            <li class="breadcrumb-item"><a href="{{ route('back.note.index') }}">Notes</a></li>
                            <li class="breadcrumb-item active">{{ $note->title }}</li>
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
                    <div class='col-md-8'>
                        <section style="margin-bottom: 2rem;">
                            <div class="btn-group-horizontal">
                                <a href="{{ route('back.note.edit', $note) }}" class="btn btn-info" data-toggle="tooltip"
                                    data-placement="top" title="Editer"><i class="fas fa-edit"></i>Editer</a>


                                <a href="{{ route('back.note.delete',$note) }}" data-method="delete" data-toggle="tooltip"
                                    data-placement="top" title="Supprimer"
                                    data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?" class="btn btn-danger"><i
                                        class="fa fa-trash"></i> Supprimer</a>


                            </div>
                        </section>
                                        
            <p class="pb-2"><b>En ligne: </b>{{ $note->online ? __('Yes') : __('No') }}</p>
            <p class="pb-2"><b>Titre: </b>{{ $note->title }}</p>
            <p class="pb-2"><b>Description: </b>{{ $note->description }}</p>
            <p class="pb-2"><b>Date ajout: </b>{{ format_date($note->created_at) }}</p>
                        {{-- add fields here --}}
                    </div>
                    <div class='col-md-4'>
                       
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
