@extends('Layouts.main')

@section('title')
    DATA KELAS PRESENSI SISWA | PRESENSI CITRA NEGARA
@endsection

@section('sub-title')
    DATA KELAS
@endsection

@section('content')
    @if ($kelas->isEmpty())
        <div class="alert alert-warning">
            <p>Data kelas masih kosong.</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($kelas as $kelasItem)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('presensi.show', ['presensi' => $kelasItem->id]) }}"
                            class="text-center text-decoration-none">
                            <div class="card-body">
                                <h2>{{ $kelasItem->kelas }}</h2>
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-chalkboard" width="80" height="80"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1" />
                                        <path d="M11 16m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
