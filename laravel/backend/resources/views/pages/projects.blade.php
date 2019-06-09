@extends('layouts.layout')

@section('content')
<h1 class="a-page__title">CATEGORIES</h1>
<div class="a-post__divider"></div>
<div class="m-categories__container">
@foreach($categories as $category)
<a class="a-category" href="/">{{ $category->name }}</a>
@endforeach
</div>

<h1 class="a-page__title">LATEST PROJECTS</h1>
<div class="a-post__divider"></div>
<div class="o-projects__container">
@foreach($projects as $project)
    <div class="o-post__container">
    <div class="a-post__image" style="background-image: url('{{ asset($project->projectimages->first()['image'] . '/' .$project->projectimages->first()['title'])}}')"></div>
        <div class="m-post__info">
            <h2 class="a-post__heading">{{ $project->title }}</h2></h2>
            <p class="a-post__paragraph">{{ $project->intro }}</p>
            <div class="m-progress__container">
                <p class="a-post__info">€{{$project->budget}} of €{{$project->goal}} backed</p>

                <?php
                $progress = $project->budget / $project->goal * 100;

                $now = date("Y-m-d"); // or your date as well
                $end_date = $project->end_date;
                $datediff = date_diff(new DateTime($now),new DateTime($end_date));
                ?>

                <div class="progress" style="background-color: lightgrey">
                    <div class="progress-bar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%; background-color: #00e50f"></div>
                </div>
                <p class="a-post__info">{{ $datediff->days }} days left</p>
            </div>
        </div>
    </div>
@endforeach
</div>

@endsection