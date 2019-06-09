@extends('layouts.layout')

@section('content')
<h1 class="a-page__title">{{ $name }}</h1>
<div class="a-post__divider"></div>
<div class="o-projects__container">
@foreach($projects as $project)
<a href="{{ route('pages.projectDetail', $project->id) }}">
    <div class="m-projects__container">
        <div class="a-project__image" style="background-image: url('{{ asset($project->projectimages->first()['image'] . '/' .$project->projectimages->first()['title'])}}')"></div>
        <div class="m-project__infoContainer">
            <h1 class="a-project__title">{{$project->title}} </h1>
            <p class="a-project__text">{{$project->intro}}</p>
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
</a>
@endforeach
</div>
<div class="m-pagination__container">
{{ $projects->links() }}
</div>

@endsection