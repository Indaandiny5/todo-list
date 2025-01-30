<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function store(Request $request) {
        $request->validate([
        // user harus mengisi nama yang tidak lebih dari 100 huruf
            'name' => 'required|max:100'
        ]);

        TaskList::create([
            'name' => $request->name
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        TaskList::findOrFail($id)->delete();

        return redirect()->back();
    }
}