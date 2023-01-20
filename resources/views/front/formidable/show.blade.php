@extends('front.layouts.default')


@section('content')

<div class="container mt-5">
    <h1 class="text-center">{{ $form->title }}</h1>

    @formidable($form)

</div>

@stop
