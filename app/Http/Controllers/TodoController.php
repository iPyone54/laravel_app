<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $instanceClass)
    {
        // dd($this->middleware('auth'));
        $this->middleware('auth');
        $this->todo = $instanceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $todos = $this->todo->all();
        $todos = $this->todo->getByUserId(Auth::id());
        // dd($todos);
        return view('todo.index', compact('todos'));
        // [‘todos’ => $todos ]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        dd($input);
        $input['user_id'] = Auth::id();
        // dd($input);
        // dd($this->todo->fill($input));
        $this->todo->fill($input)->save();
        // dd($this->todo->fill($input));
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        // dd($this->todo);
        $todo = $this->todo->find($id);
        // $text = 'aaaaaa';
        // dd($todo);
        return view('todo.edit', compact('todo'));
        // ['todolist' => $todo]
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        // dd($this->todo->find($id)->fill($input));
        $this->todo->find($id)->fill($input)->save();
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($this->todo->find($id));
        // dd($this->todo->find($id)->delete());
        $this->todo->find($id)->delete();
        return redirect()->to('todo');
    }
}
