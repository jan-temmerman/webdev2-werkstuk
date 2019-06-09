@extends('layouts.layout')

@section('content')
@auth
<h1 class="a-page__title">Attention</h1>
<div class="a-post__divider"></div>

<a class="a-profile__button" href="{{ URL::previous() }}">Cancel</a>
<a class="a-profile__button--danger" href="/">Delete Project</a>

<form action="{{route('user.delete_project',[$project_id])}}" method="POST">
 @method('POST')
 @csrf
 <button type="submit" class="a-profile__button--danger">Delete Project</button>               
</form>

@endauth
@endsection