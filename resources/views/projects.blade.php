@extends('master')
@section('user')

  @php
      $showEmptyMessage = 0;
  @endphp

  @livewire('student-projects', ['currentPage' => $currentPage]);

@endsection