<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'todo_lists';

    public function list_items(){
        return $this->hasMany(ListItem::class, 'list_id' );
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function getCountDoneAttribute(){
        return $this->list_items()->where('is_done', 1)->count();
    }
}
