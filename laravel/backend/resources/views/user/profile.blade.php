@extends('layouts.layout')

@section('content')
@auth
<h1 class="a-page__title">PROFILE</h1>
<div class="a-post__divider"></div>

<div class="m-profile__container">
    <h2 class="a-profile__subtitle">Name:</h2>
    <p>{{ Auth::user()-> firstname}} {{ Auth::user()-> lastname}}</p>
    <h2 class="a-profile__subtitle">E-Mail:</h2>
    <p>{{ Auth::user()-> email}}</p>
    <h2 class="a-profile__subtitle">Credits:</h2>
    <p>{{ Auth::user()-> credits}}</p>
    <div class="m-profile__actions">
        <a class="a-profile__button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
        </a>
        <a class="a-profile__button" href="{{ route('user.payment') }}">Get Credits</a>
        <a class="a-profile__button--danger" href="{{ route('user.delete') }}">Delete account</a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
    </form>
</div>

<h1 class="a-page__title">PROJECTS</h1>
<div class="a-post__divider" style="margin-bottom: 20px;"></div>

<a class="a-profile__button" href="{{ route('projects.add_project') }}">Add a project</a>

<div class="m-profile__projectsContainer">
    @foreach($projects as $project)

    <?php
        $progress = round($project->budget / $project->goal * 100);

        $now = date("Y-m-d"); // or your date as well
        $end_date = $project->end_date;
        $datediff = date_diff(new DateTime($now),new DateTime($end_date));
    ?>

    <div class="m-profile__projectContainer">
        <p class="a-profile__projectInfo">{{ $project->title }}</p>
        <p class="a-profile__projectInfo"> {{ $progress }}% funded</p>
        <p class="a-profile__projectInfo">{{ $datediff->days }} day(s) left</p>
        <div class="m-profile__projectActions">
            <img class="a-profile__icon" src="{{ asset('storage/images/menu.png') }}" alt="edit">
            <form action="/profile/delete_project/{{ $project->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="a-button__delete"><img class="a-profile__icon" src="{{ asset('storage/images/delete.png') }}" alt="delete"></button>               
            </form>
        </div>
    </div>
    @endforeach
</div>
@endauth
@endsection