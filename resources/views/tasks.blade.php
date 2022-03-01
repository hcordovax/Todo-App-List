@extends('layouts.app')
<style>
        input[type=checkbox]:checked + label.strikethrough{
                            text-decoration: line-through;
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">    
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $todolist->name }}</div>
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
                    <!-- <form action="/tasks/{{$todolist->id}}/new_task" method="POST">
                        @csrf

                        <input type="text" name="task">
                        <input type="submit" value="Create SubTask" >
                    </form> -->
                    <a href="/home" class="btn btn-outline-secondary text-dark  float-right" >Back</a>
                    <br><br>
                    <form action="/tasks/{{$todolist->id}}/new_task" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="text" name="task">    
                            </div>
                            <div class="col">
                                <input class="btn btn-secondary text-light" type="submit" value="Create SubTask" >
                            </div>
                        </div>
                    </form>

                    <ul class="list-group">
                            @foreach($todolist->list_items as $list_item)
                            <li class="list-group-item">
                                <div>
                                    <form id="formIsDone_{{ $list_item->id }}" action="/tasks/{{$todolist->id}}/mark_as_done" method="POST">
                                        @csrf
                                        <input type="hidden" name="list_item_id" value="{{ $list_item->id }}"/>
                                        <input type="hidden" name="is_done" value="{{ $list_item->is_done }}"/>
                                        
                                        <input onchange="document.getElementById('formIsDone_{{ $list_item->id }}').submit()" 
                                        type="checkbox" value="1" 
                                        {{ $list_item->is_done ? 'checked': '' }} />
                                        <label for="packers" class="strikethrough">{{ $list_item->task}}</label>
                                    </form>
                                        @if($list_item->is_done == false)
                                        <a href="/tasks/edit/{{$list_item->id}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Edit</a>
                                        @endif

                                        @if($list_item->is_done == true)
                                        <a href="/tasks/delete/subtasks/{{$list_item->id}}" class="btn btn-danger" >Delete</a>
                                        @endif
                                                <!-- The Modal -->
                                                <div class="modal fade" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit {{ $list_item->task }}</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="/tasks/edit/subtask/{{$list_item->id}}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="text" name="task" value="{{ $list_item->task}}">
                                                                    <button class="btn btn-warning" type="submit">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function markAsDone(id){
        console.log('Mark as Done' + id);
    }
</script>
@endsection
