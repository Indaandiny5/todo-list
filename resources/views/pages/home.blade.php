@extends('layouts.app')

@section('content')

    <style>
        /* Mengatur gambar latar belakang untuk elemen dengan ID 'content' */
        #content {
            background-image: url('{{ asset('images/Why I Like to Instagram the Sky.jpg') }}'); /* Menggunakan gambar dari folder public/images/yg bernama background image */
            background-size: cover; /* Memastikan gambar menutupi seluruh area */
            background-position: center; /* Memposisikan gambar di tengah */
            color: white; /* Mengubah warna teks menjadi putih untuk kontras yang lebih baik */
            min-height: 100vh; /* Memastikan konten memenuhi tinggi layar */
            
        }
        .card {
         background: rgba(255, 255, 255, 0.15);
         backdrop-filter: blur(50px);
         border-radius: 15px;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         border: 1px solid rgba(0, 0, 0, 0.3);
}        
        /* Mengatur gaya untuk kartu agar memiliki latar belakang transparan */
        .card {
            background-color: rgba(169, 182, 204, 0.9); /* Memberikan latar belakang putih dengan transparansi 90% */
            transition: transform 0.2s; /* Menambahkan efek transisi saat hover */
            box-shadow: 0 4px 20px rgba(6, 6, 6, 0.2); /* Menambahkan bayangan pada kartu */
        }
        .card:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }
        .btn {
            transition: background-color 0.3s, transform 0.2s; /* Transisi untuk tombol */
        }
        .btn:hover {
            transform: scale(1.1); /* Efek zoom saat hover pada tombol */
        }
        .badge {
            font-size: 0.9em; /* Ukuran font badge */
        }
    </style>

    <div id="content" class="overflow-y-hidden overflow-x-hidden">
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-prImary"
                    style="width: fit-content;">
                    <i class="bi bi-plus-square fs-3"></i> Tambah
                </button>
            </div>
        @endif
        <div class="d-flex flex-wrap gap-4 px-3 justify-content-center mt-4" style="height: 100vh;">
            @foreach ($lists as $list)
                <div class="card shadow-lg border-0 rounded-lg" style="width: 20rem; max-height: 85vh;">
                    <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">{{ $list->name }}</h5>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-white"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column justify-content-center gap-2">
                                                <a href="{{ route('tasks.show', $task->id) }}"
                                                    class="fw-bold text-dark lh-1 m-0 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                    {{ $task->name }}
                                                    {{--a href itu untuk membuat link--}}
                                                </a>
                                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill"
                                                    style="width: fit-content">
                                                    {{ $task->priority }}
                                                </span>
                                            </div>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm p-0">
                                                    <i class="bi bi-x-circle text-danger fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-truncate">
                                            {{ $task->description }}
                                        </p>
                                    </div>
                                    @if (!$task->is_completed)
                                        <div class="card-footer">
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success w-100">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check fs-5"></i>
                                                        Selesai
                                                    </span>
                                                </button>
                                            </form>

                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
            <button type="button" class="btn btn-outline-success flex-shrink-0" style="width: 18rem; height: fit-content;"
                data-bs-toggle="modal" data-bs-target="#addListModal">
                <span class="d-flex align-items-center justify-content-center">
                    <i class="bi bi-plus fs-5"></i>
                    Tambah
                </span>
            </button>
        </div>
    </div>
@endsection