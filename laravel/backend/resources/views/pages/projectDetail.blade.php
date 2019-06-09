@extends('layouts.layout')

@section('content')
<h1 class="a-page__title">{{ strtoupper($project->title) }}</h1>
<div class="a-post__divider"></div>

<div class="o-detail__container">
    <div class="m-rewards__container">
        <h1 class="a-page__title">Rewards</h1>
        <div class="a-post__divider"></div>
        @foreach($rewards as $reward)
        <div class="m-reward__container">
            <h3 class="a-reward__title">{{ $reward->name }}</h3>
            <p class="a-reward__intro">{{ $reward->intro }}</p>
            <p class="a-reward__important">Fund</p>
            <p class="a-reward__amount">{{ $reward->at_amount }} credits or more</p>
        </div>
        @endforeach
    </div>

    <div class="o-project__container">
        <div class="m-detail__projectContainer">
            <div class="a-detail__projectImage" style="background-image: url('{{ asset($project->projectimages->first()['image'] . '/' .$project->projectimages->first()['title'])}}')"></div>
            <div class="m-project__infoContainer">
                <h1 class="a-project__title">{{$project->title}} </h1>
                <p class="a-project__text">{{$project->intro}}</p>

                <p class="a-post__info">€{{$project->budget}} of €{{$project->goal}} backed</p>
                <div class="progress" style="background-color: lightgrey">
                    <div class="progress-bar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:{{$progress}}%; background-color: #00e50f"></div>
                </div>
                <p class="a-post__info">{{ $datediff->days }} days left</p>

                <h1 class="a-project__subtitle">Help them reach their goal!</h1>
                <p class="a-project__text">Like this project? Help them reach their goal by giving them credits,<br>If you fund enough you get one of their perks!</p>

                @if(Auth::user())
                @if(!($project->user_id == Auth::user()->id))
                <form action="{{ route('pages.fundProject', $project->id) }}" method="post">
                    @csrf
                        <div class="m-fund__container">
                            <label class="a-fund__title">Credits</label>
                            <input class="a-fund__input" name="amount" type="number" value="10">
                            <button class="a-fund__submit" type="submit">Fund!</button>
                        </div>
                </form>
                @endif
                @endif

                @if(isset($errormsg))
                <p>{{ $errormsg }}</p>
                @endif
            </div>
        </div>

        <h1 class="a-page__title">IMAGES</h1>
        <div class="a-post__divider"></div>

        @foreach($project->projectImages as $image)
        <div class="a-detail__projectImage" style="background-image: url('{{ asset($image->image . '/' .$image->title) }}')"></div>
        @endforeach

        <h1 class="a-page__title">COMMENTS</h1>
        <div class="a-post__divider"></div>

        <div class="o-comments__container">
        @if(Auth::user())
            <div class="m-comments__inputContainer">
            <label class="a-comment__title">Do you have something to say about the project?</label>
                <form class="m-comments__formContainer" action="{{ route('pages.commentProject', $project->id) }}" method="post">
                    @csrf
                    <textarea class="a-comment__input" name="comment" type="text"></textarea>
                    <button class="a-comment__submit" type="submit">Post</button>
                </form>
            </div>
        @endif
            @foreach($comments as $comment)
            <div class="m-comment__container">
                <!--<p class="a-reward__important">$comment->userClass 'App/User' not found->firstname }}</p>-->
                <p class="a-project__text">{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection