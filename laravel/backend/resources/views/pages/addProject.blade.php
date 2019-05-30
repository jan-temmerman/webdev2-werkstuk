@extends('layouts.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        <div class="card-header">{{ __('New Project') }}</div>
            <div class="card-body">
                <form action="{{ route('projects.save') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="" />

                    <div class="column">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Name of the project</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">intro about the project</label>
                            <div class="col-md-6">
                                <input class="input-lg form-control{{ $errors->has('intro') ? ' is-invalid' : '' }}" name="intro" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Financial goal</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('goal') ? ' is-invalid' : '' }}" name="goal" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-md-4 col-form-label text-md-right">End date</label>
                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" type="date" value="">
                            </div>    
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Category</label>
                            <div class="col-md-6">
                                <select class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">

                                    @foreach($categories as $category) :
                                        <option value="{{$category->id}}" > {{ucfirst($category->name)}} </option>
                                    @endforeach;

                                </select>
                            </div>
                        </div>
                        <div class="medium-12  columns">
                            <button class="button success hollow" type="submit">BEWAAR</button>
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
