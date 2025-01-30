<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        // untuk mengambil data variable yang ada di dalam folder models/task
        $data = [
            'title' => 'Home',
            // membuat judul untuk tampilan Home
            'lists' => TaskList::all(),
            // lists untuk mengambil semua TaskList yang ada di folder models/TaskList
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
             // orderBy desc mengurutkan dari yang terbesar ke yang terkecil
            'priorities' => Task::PRIORITIES
            // untuk mengambil nilai priorities dari const yang ada di app/models/task
        ];
    

        return view('pages.home', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }

    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }
}