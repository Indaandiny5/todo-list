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

        return redirect()->back();
        // Mengembalikan pengguna ke halaman sebelumnya setelah tugas dihapus
    }

    public function show($id)
    {
        $task = Task::findOrfail($id);
        // findOrfail,untuk Mmencari tugas berdasarkan id
        $data = [
            'title' => 'Details',
            'task' => $task,
        ];
        return view('pages.details', $data);
        // untuk mengirim data ke tampilan (pages.details) untuk ditampilkan kepada pengguna
    }
}
