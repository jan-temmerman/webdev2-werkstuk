@extends('layouts.layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        <div class="card-header">{{ __('Add Rewards') }}</div>
            <div class="card-body">
                <form action="{{ route('projects.saveReward') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="" />

                    <div class="column">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Name of the reward</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="name" type="text" value="{{ old('title', $reward->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Intro about the reward</label>
                            <div class="col-md-6">
                                <textarea style="height: 120px;" class="input-lg form-control{{ $errors->has('intro') ? ' is-invalid' : '' }}" name="intro" type="text" value="{{ old('intro', $reward->intro) }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Amount of money that needs to be funded</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('goal') ? ' is-invalid' : '' }}" name="at_amount" type="number" value="{{ old('goal', $reward->at_amount) }}">
                            </div>
                        </div>
                        <div class="medium-12  columns">
                            <button class="button success hollow" type="submit">COMPLETE</button>
                        </div>
                    </div>
                </form>
                @if($errors->any())
                <div class="errors" >
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection