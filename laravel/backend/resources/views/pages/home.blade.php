@extends('layouts.layout')

@section('content')
<div class="p-post__container">
    <h1 class="a-page__title">Welcome to BACKEND!</h1>
    <p class="a-page__intro">Here you can back endless projects! <br>Put up your project for crowdfunding or fund projects yourself! </p>
    <h1 class="a-page__title">LATEST NEWS</h1>
    <div class="a-post__divider"></div>
    <div class="o-post__container">

        <div class="a-post__image" style="background-image: url('{{ asset($latestProject->projectimages->first()['image'] . '/' . $latestProject->projectimages->first()['title'])}}')"></div>
        <div class="m-post__info">
            <h2 class="a-post__heading">{{ $latestProject->title }}</h2>
            <p class="a-post__paragraph">{{ $latestProject->intro }}</p>
        </div>
    </div>

    <h1 class="a-page__title">LATEST PROJECT</h1>
    <div class="a-post__divider"></div>
    <div class="o-post__container">
    <div class="a-post__image" style="background-image: url('{{ asset($latestProject->projectimages->first()['image'] . '/' . $latestProject->projectimages->first()['title'])}}')"></div>
        <div class="m-post__info">
            <h2 class="a-post__heading">{{ $latestProject->title }}</h2></h2>
            <p class="a-post__paragraph">{{ $latestProject->intro }}</p>
            <p class="a-post__info">€{{$latestProject->budget}} of €{{$latestProject->goal}} backed</p>
            <div class="progress" style="background-color: lightgrey">
                <div class="progress-bar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%; background-color: #00e50f"></div>
            </div>
            <p class="a-post__info">{{ $datediff->days }} days left</p>
        </div>
    </div>
</div>
@endsection