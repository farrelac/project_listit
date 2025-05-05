<?php

namespace App\Http\Controllers\ToDo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 3;

        if(request('search')){
            $data = Todo::where('task', 'like', '%'.request('search').'%') -> paginate($max_data) -> withQueryString();
        } else {
            $data = Todo::orderBy('task', 'asc') -> paginate($max_data);
        }
        return view("ToDo.app", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() //untuk menampilkan di form nya
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //untuk menyimpan data
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Task Wajib Diisi!',
            'task.min' => 'Minimal 3 Karakter Cuyy!',
            'task.max' => 'Maksimal 25 Karakter Cuyy!'

        ]);

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect() -> route('todo') -> with('success', 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Task Wajib Diisi!',
            'task.min' => 'Minimal 3 Karakter Cuyy!',
            'task.max' => 'Maksimal 25 Karakter Cuyy!'
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done') // Perbaikan di sini
        ];

        Todo::where('id', $id)->update($data);
        return redirect() -> route('todo') -> with('success', 'Berhasil menyimpan perbaikan data');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id) -> delete();
        return redirect() -> route('todo') -> with('success', 'Berhasil menghapus data');
    }
}
