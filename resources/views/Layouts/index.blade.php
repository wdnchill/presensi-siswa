@extends('Layouts.main')

@section('title')
    DASBOARD | PRESENSI CINTRA NEGARA
@endsection

@section('sub-title')
    Dashboard
@endsection

@section('content')
                  <div>
                    <select class="form-select">
                      <option value="1">March 2023</option>
                      <option value="2">April 2023</option>
                      <option value="3">May 2023</option>
                      <option value="4">June 2023</option>
                    </select>
                  </div>
                <div id="chart"></div>
@endsection
