<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Zendesk\API\Utilities\Auth;

class TodosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'title' => 'required',
            'body' => ''
        ]);

        $todo = new Todo();
        $todo->user_id = auth()->user()->id;
        $todo->title = $data['title'];
        $todo->body = $data['body'];
        $todo->save();

        return \request()->json([
            'message' => 'Todo saved'
        ]);
    }

    public function index()
    {
        return Todo::all()->where('user_id', auth()->user()->id);
    }

    public function show($id)
    {
        return Todo::find($id);

    }

    public function update($id)
    {
        $todo = Todo::find($id);
        $data = request()->all();
        $todo->update(request()->all());
        return $todo;
    }

    public function destroty($id)
    {
        return Todo::destroy($id);
    }
}
