@extends('layouts.layout')

@section('content')
<h1 class="a-page__title">LATEST PROJECTS</h1>
<div class="a-post__divider"></div>
<div class="o-projects__container">
@foreach($projects as $project)
    <div class="m-projects__container">
        <div class="a-project__image" style="background-image: url('https://via.placeholder.com/400x1000')"></div>
        <h1 class="a-project__title">{{$project->title}} </h1>
        <p class="a-project__text">{{$project->intro}}</p>
    </div>
@endforeach
</div>

@endsection