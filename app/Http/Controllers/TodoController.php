<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('index', ['data' => Todo::all()]);
    }

    public function show(Todo $id)
    {
        return $id;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'expires_at' => 'required'
        ]);

        try {
            Todo::create($request->all());
            return redirect('/')->with('success', 'Task cadastrada com sucesso');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', 'Erro ao cadastrar a task');
        }
    }

    public function update(Request $request, Todo $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'expires_at' => 'required'
        ]);

        // ['title' => $id->title, 'description' => $id->description, 'expires_at' => $id->expires_at]
        try {
            Todo::where('id', $id->id)->update($request->only(['title', 'description', 'expires_at']));
            return redirect('/')->with('success', 'Task cadastrada com sucesso');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete(Todo $id)
    {
        try {
            Todo::where('id', $id->id)->delete($id);
            return redirect('/')->with('success', 'Task Excluida com sucesso');
        } catch (\Exception $exception) {
            return redirect('/')->with('danger', 'Erro ao excluir a task');
        }
    }

    public function done(Request $request, Todo $id)
    {

        $done = '';
        $doneFrase = '';
        if ($request->only('done')['done'] == '1') {
            $done = 0;
            $doneFrase = 'desfeita';
        } else {
            $done = 1;
            $doneFrase = 'feita';
        }

        try {
            Todo::where('id', $id->id)->update(['done' => $done]);
            return redirect('/')->with('success', 'Task ' . $doneFrase . ' com sucesso');
        } catch (\Exception $exception) {
            return redirect('/')->with('danger', 'Erro ao atualizar a task');
        }
    }

    public function todoForm()
    {
        return view('todo-form');
    }

    public function todoFormUpdate(Todo $id)
    {
        return view('todo-form', ['data' => $id]);
    }
}
