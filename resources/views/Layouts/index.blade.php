@extends('Layouts.main')

@section('title')
    DASHBOARD | PRESENSI CITRA NEGARA
@endsection

@section('sub-title')
    Dashboard
@endsection

@section('content')
    @if (auth()->user()->role == 'admin')
    <div class="container">
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h1 class="card-title text-white display-5">
                        <strong>Total Siswa:</strong>
                    </h1>
                    <h2 class="card-text text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                        <strong>{{ $siswas }}</strong>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h1 class="card-title text-white display-5">
                        <strong>Total User:</strong>
                    </h1>
                    <h2 class="card-text text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-filled" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" stroke-width="0" fill="currentColor" /></svg>
                         <strong>{{ $users }}</strong>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h1 class="card-title text-white display-5 ">
                        <strong>Total Kelas:</strong>
                    </h1>
                    <h2 class="card-text text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chalkboard" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1" /><path d="M11 16m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>
                        <strong>{{ $kelas }}</strong>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h1 class="card-title text-white display-5 ">
                        <strong>Total Presensi:</strong>
                    </h1>
                    <h2 class="card-text text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-writing" width="60" height="60" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" /><path d="M16 7h4" /><path d="M18 19h-13a2 2 0 1 1 0 -4h4a2 2 0 1 0 0 -4h-3" /></svg>
                        <strong>{{ $absensiHariIni }}</strong>
                    </h2>
                </div>
            </div>
        </div>
    </div>
  
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="500" height="500" aria-label="Hello ARIA World" ></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart2" width="500" height="400" aria-label="Hello ARIA World" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Hadir', 'Sakit', 'Izin', 'Alfa'],
            datasets: [{
                label: '# Keterangan siswa',
                data: [
                    {{ $hadirCount }}, // Data jumlah hadir
                    {{ $sakitCount }}, // Data jumlah sakit
                    {{ $izinCount }},  // Data jumlah izin
                    {{ $alfaCount }}   // Data jumlah alfa
                ],
                backgroundColor: [
                    'rgba(66, 245, 69, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderWidth: [
                    1, 
                    1, 
                    1, 
                    1  
                ],
                borderColor: [
                    'rgb(66, 245, 69)',
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
const ctxPolar = document.getElementById('myChart2');

const dataPolar = {
    labels: ['Hadir', 'Sakit', 'Izin', 'Alfa'],
    datasets: [{
        label: '# Keterangan siswa',
        data: [
            {{ $hadirCount }}, 
            {{ $sakitCount }}, 
            {{ $izinCount }},  
            {{ $alfaCount }}   
        ],
        backgroundColor: [
            'rgba(66, 245, 69, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
            'rgb(66, 245, 69)',
            'rgb(255, 205, 86)',
            'rgb(54, 162, 235)',
            'rgb(255, 99, 132)',
        ],
        borderWidth: 1,
    }]
};

new Chart(ctxPolar, {
    type: 'doughnut', // Mengubah jenis chart menjadi doughnut
    data: dataPolar,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

</div>  @elseif (auth()->user()->role == 'walas' || auth()->user()->role == 'guru')
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h1 class="card-title text-white">Informasi Presensi</h1>
                    <p class="card-text">Guru memilih kelas yang ingin dilakukan presensi lalu mengisi mata pelajaran dan keterangan siswa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h1 class="card-title text-white">Informasi Laporan</h1>
                    <p class="card-text">Lakukan Filter data presensi sebelum mencetak laporan.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h1 class="card-title text-white">Hubungi Kami</h1>
                    <p class="card-text">Hubungi admin via WhatsApp di <strong>+62 123 4567 8901</strong> jika ada kendala atau error saat melakukan presensi atau mencetak laporan.</p>
                </div>
            </div>
        </div>
       <div class="col-md-6 mb-4">
    <div class="card d-flex justify-content-center align-items-center">
        <img src="{{ asset('storage/'.auth()->user()->imguser) }}" alt="userimg" width="150"
         height="150" class="rounded-circle mt-2 ">
        <div class="card-body text-center">
            <h1 class="card-title">{{ auth()->user()->name }}</h1>
            <p class="card-text">Email: {{ auth()->user()->email }}</p>
            <p class="card-text">Role: {{ auth()->user()->role }}</p>
        </div>
    </div>
</div>

    </div>
</div>
@endif
@endsection
