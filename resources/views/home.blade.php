@extends('layouts.app')
<style>
    .text1{
        color: green;
        font-family: sans-serif;
      
    }
    .text2{
        color: black;
        font-family: sans-serif;
       
    }
    .text3{
        color: blue;
        font-family: sans-serif;
    }
    
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo-List App') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/save_new_todolist" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="text" name="name" placeholder="Create Todo-List Now">    
                            </div>
                            <div class="col">
                                <input class="btn btn-success text-light" type="submit" value="Create Todo" >
                            </div>
                        </div>
                    </form>
                    
                    <ul class="list-group">
                        @foreach($todoLists as $todolist)
                            <li class="list-group-item">
                                <div>   
                                    <a href="/tasks/{{$todolist->id}}" class="btn btn-outline-dark">{{$todolist->name}}</a><br>
                                    <text class="text1"> Done: {{ $todolist->count_done }}</text> | <text class="text2">Total Sub-Task: {{$todolist->list_items()->count()}}</text> | <textt class="text3">created : {{ $todolist->created_at->diffForHumans() }} </text> 
                                    @if(!$todolist->list_items()->count()) 
                                    <a href="/tasks/delete/{{$todolist->id}}" class="btn btn-danger btn-md" >Delete</a>
                                    @endif 
                                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse"  data-bs-target="#collapseOne" aria-expanded="false">Edit</button>
                                    
                                        <div class="collapse mt-2" id="collapseOne">
                                            <div class="card card-body">
                                                <form action="{{ url('/tasks/edit/todo/'.$todolist->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name='name' value="{{$todolist->name}}" >
                                                    <button class="btn btn-secondary">Update</button>
                                                </form> 
                                            </div>
                                        </div> 
                                        
                                        <!-- Open Modal -->
                                                    
                                        <!-- Close Modal -->

                                </div>  
                                
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
