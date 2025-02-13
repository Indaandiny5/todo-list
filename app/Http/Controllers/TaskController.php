<?php

// task controller digunakan untuk menampilkan fungsi daftar tugas, menambahkan tugas baru
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // untuk menampilkan daftar tugas
    public function index()
    {
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'list_id' => 'required',
            'description' => 'nullable|max:100',
            'priority' => 'required|in:high,medium,low'
        ]);
        // public function store(Request $request) digunakan untuk menyimpan data baru ke dalam basis data
        // nullable artinya boleh dkosongkan
        // priority digunakan untuk menambahkan data 
        Task::create([
            'name' => $request->name,
            'list_id' => $request->list_id,
            'description' => $request->description,
            'priority' => $request->priority
        ]);


        return redirect()->back();
    }

    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
        // untuk mengembalikan pengguna ke halaman sebelumnya setelah tugas diperbarui
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('home');
        // Mengembalikan pengguna ke halaman sebelumnya setelah tugas dihapus
    }

    public function show($id)
    {
        $data = [
            'title' => 'Task',
            'lists' => TaskList::all(),
            'task' => Task::findOrFail($id),
        ];

        return view('pages.details', $data);
    }
    public function changeList(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required|exists:task_lists,id',
        ]);

        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui!');
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'priority' => 'required|in:low,medium,high'
        ]);

        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
    }
}
 // findOrfail,untuk mencari tugas berdasarkan id
 // untuk mengirim data ke tampilan (pages.details) untuk ditampilkan kepada pengguna