<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\ListItem;


class TodoListController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
      
        $list = new TodoList();
        $list->name = $request->get('name');
        $list->user_id = Auth::user()->id;
        $list->save();

        return redirect()->back();
    }
    public function show($list_id){

        $todolist = Auth::user()->todo_list()->findOrFail($list_id);
        return view('tasks', compact('todolist'));
    }

    public function addtask(Request $request, $list_id){
        $todolist = Auth::user()->todo_list()->findOrFail($list_id);
        $list_item = new ListItem();
        $list_item->task = $request->get('task');
        $list_item->list_id = $todolist->id;
        $list_item->user_id = Auth::user()->id;
        $list_item->save();

        return redirect()->back();
    }

    public function markTaskAsDone(Request $request, $list_id){

        $list_item_id = $request->get('list_item_id');
        $is_done = $request->get('is_done');

        $list_item = Auth::user()->list_items()->findOrFail($list_item_id);
        $list_item->is_done = !$is_done;
        $list_item->save();

        return redirect()->back();

    }

    public function destroy($list_id){
        $todolist = Auth::user()->todo_list()->findOrFail($list_id);
        
        if($todolist->list_items()->count()){
            return back()->withErrors(' Please delete Subtasks ');
        }
        $todolist = Auth::user()->todo_list()->findOrFail($list_id)->delete();
    
        return redirect()->back()->with('status', 'Successfully deleted!');

    }
    public function removesubtask($list_id){
     
        $list_item =ListItem::find($list_id)->delete();
        return redirect()->back()->with('status', 'Successfully deleted!');

    }
    public function edittodo(Request $request, $id){
        
        $request->validate([
            'name' => 'required|max:200'
        ]);
        $todolist = Auth::user()->todo_list()->findOrFail($id);
        $todolist->name = $request->name;
        $todolist->save();
        
        return redirect()->back()->with('status', 'Successfully updated!');
    }
    public function editsubtask(Request $request, $id){

        $request->validate([
            'task' => 'required|max:200'
        ]);

        $list_item = Auth::user()->list_items()->findOrFail($id);
        $list_item->task = $request->task;
        $list_item->save();
        
        return redirect()->back()->with('status', 'Successfully updated!');
        
    }

    
}
