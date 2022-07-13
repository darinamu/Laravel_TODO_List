<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodosRequest;
use App\Models\Todos;
use App\Models\TodoStatusHistory;
use LDAP\Result;
use Requests;

class MainController extends Controller
{
    public function home() {
        $todos = new Todos();
        return view('home', ['todos' => $todos->all()]);
    }

    public function ShowOneTodo($id) {
        $onetodo = new Todos;
        $statuses = TodoStatusHistory::where('todo_id', $id)->get();
        return view('onetodo', ['onetodo' => $onetodo->find($id)], ['statuses' => $statuses]);
    }

    public function create(TodosRequest $request) {

        $todo = new Todos();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->status = $request->input('status');
        $todo->user = $request->input('user');
        $todo->label = $request->input('todoTag');

        $todo->save();

        return redirect('/');

    }

    public function edit($id, Request $request) {

        $todo = Todos::find($id);
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->status = $request->input('status');
        $todo->user = $request->input('user');
        $todo->label = $request->input('todoTag');

        $todo->save();

        return back();

    }

    public function edit_status($id, Request $request) {

        $edit_status = Todos::find($id);
        $edit_status->status = $request->input('edit_status');
        $edit_status->user = $request->input('todo_user');

        $edit_status->save();

        $status_history = new TodoStatusHistory;
        $status_history->todo_id = $id;
        $status_history->todo_status = $edit_status['status'];
        $status_history->todo_user = $edit_status['user'];

        $status_history->save();

        return back()->withInput();

    }

    public function filter(Request $request) {
        $filter = $request->input('label_filter');
        $todos = Todos::where('label', $filter)->get();
        return view('home', ['todos' => $todos]);
    }

    public function DeleteTodo($id) {
        Todos::find($id)->delete();
        return redirect('/');
    }

}

