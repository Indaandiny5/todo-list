@extends('layouts.app')

@section('content')
    <div id="content" class="container">
    </div>
    <div class="d-flex align-items-center">
        <a href="{{ route('home') }}" class="btn btn-sm fw-bold fs-4">
            <i class="bi bi-arrow-left-short"></i>
            Kembali
        </a>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card" style="height: 80vh; max-height:80vh">
                <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                    <h3 class="fw-bold fs-4 text-truncate" style="max-width: 80%;">{{ $task->name }}</h3>
                    <button class="btn btn-sm">
                        <i class="bi bi-pencil-square fs-4"></i>
                    </button>
                </div>
                <div class="card-body">
                    <p>
                        {{ $task->description }}
                    </p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-danger w-100">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="height: 80vh; max-height:80vh"></div>
        </div>
    </div>
    </div>
@endsection
