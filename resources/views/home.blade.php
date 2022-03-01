@extends('layouts.app')
<style>
    .text1{
        color: green;
    }
    .text2{
        color: red;
    }
    
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo-List Application') }}</div>

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
                                <input class="form-control" type="text" name="name">    
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
                                        <h5><a href="/tasks/{{$todolist->id}}">{{$todolist->name}}</a></h5>
                                        
                                        <a href="/tasks/edit/task/{{$todolist->id}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" >Edit</a>
                                        @if(!$todolist->list_items()->count()) 
                                        <a href="/tasks/delete/{{$todolist->id}}" class="btn btn-danger" >Delete</a>
                                        @endif
                                        <text class="text1"> Done: {{ $todolist->count_done }}</text> | <text class="text2">Total Subtask: {{$todolist->list_items()->count()}}</text> 

                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editing {{$todolist->name}} </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <form action="/tasks/edit/subtask/{{$todolist->id}}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="text" name="name" value="{{ $todolist->name}}">
                                                                    <button class="btn btn-warning" type="submit">Update</button>
                                                                </form>
                                                </div>

                                                

                                                </div>
                                            </div>
                                            </div>

                                </div>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
