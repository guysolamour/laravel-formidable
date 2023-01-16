@extends(back_view_path('layouts.base'))


@section('title','Notes')


@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <div class='float-sm-right'>
                          <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                      <li class="breadcrumb-item active">Notes</li>
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
                    <div class="col-md-12">
                        <div class="card" style='box-shadow: 0 0 1px rgba(0,0,0,0), 0 1px 3px rgba(0,0,0,0);'>

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">notes</h3>
                                        <div class="btn-group float-right">
                                            <a href="{{ route('back.note.create') }}" class="btn  btn-primary"> <i
                                                    class="fa fa-plus"></i> Ajouter</a>


                                            <a href="#" class="btn btn-danger d-none" data-model="\App\Models\Note"
                                                id="delete-all"> <i class="fa fa-trash"></i> Tous supprimer</a>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped" id="list">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="check-all">
                                                                <label class="custom-control-label"
                                                                    for="check-all"></label>
                                                            </div>
                                                        </th>
                                                        <th>#</th>

                <th>En ligne</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date création</th>

                                                        {{-- add fields here --}}
                                                        <th>Actions</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($notes as $note)
                                                    <tr>
                    <td>
      <div class="custom-control custom-checkbox">
          <input type="checkbox" data-check
              class="custom-control-input"
              data-id="{{ $note->id }}"
              id="check-{{ $note->id }}">
          <label class="custom-control-label"
              for="check-{{ $note->id }}"></label>
      </div>
  </td>

                <td>{{ $loop->iteration }}</td>
                <td>{{ $note->online ? __('Yes')  : __('No') }}</td>
                <td>{{ Str::limit($note->title, 50) }}</td>
                <td>{{ Str::limit($note->description, 50) }}</td>
                <td>{{ format_date($note->created_at) }}</td>
                                                        {{-- add values here --}}
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                   <a href="{{ route('back.note.show', $note) }}"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    data-placement="top" title="Afficher"><i
                                                                        class="fas fa-eye"></i></a>

                                                                   <a href="{{ route('back.model.clone', get_clone_model_params($note)) }}"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    data-placement="top" title="Cloner"><i
                                                                        class="fas fa-clone"></i></a>

                                                                
                                                                <a href="{{ route('back.note.edit', $note) }}"
                                                                    class="btn btn-info" data-toggle="tooltip"
                                                                    data-placement="top" title="Editer"><i
                                                                        class="fas fa-edit"></i></a>

                                                                
  <a href="{{ route('back.note.delete',$note) }}"
      data-method="delete"
      data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?"
      class="btn btn-danger" data-toggle="tooltip"
      data-placement="top" title="Supprimer"><i
          class="fas fa-trash"></i></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>



<x-administrable::datatable />
@deleteAll
@endsection




