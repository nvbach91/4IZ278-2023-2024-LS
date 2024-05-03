<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoListController extends Controller
{
    public function saveTodo(TodoRequest $request) {
        $newTodo = new Todo();
        $newTodo->title = $request->title;
        $newTodo->finished = 0;
        $newTodo->save();
        return redirect('todos');
    }

    public function finishTodo($id) {
        $todo = Todo::find($id);
        $todo->finished = 1;
        $todo->save();
        return redirect('todos');
    }

    public function unfinishTodo($id) {
        $todo = Todo::find($id);
        $todo->finished = 0;
        $todo->save();
        return redirect('todos');
    }

    public function deleteTodo($id) {
        Todo::where('id', $id)->delete();
        return redirect('todos');
    }
}
