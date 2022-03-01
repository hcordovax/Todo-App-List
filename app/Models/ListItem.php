<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    public function todo_list(){
        return $this->belongsTo(TodoList::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
