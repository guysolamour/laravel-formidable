@extends(back_view_path('layouts.base'))

@section('title','Edition ' . $note->title)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Edition</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.note.index') }}">Notes</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('back.note.show', $note) }}">{{ $note->title }}</a></li>
                            <li class="breadcrumb-item active">Edition</li>
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
                <h3 class="card-title">Edition</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Réduire">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class='col-md-8'>
                       @include('back.notes._form', ['edit' => true])
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
