@extends('master')
@section('user')

<form action="{{ url('projects') }}" method="get">  
  @livewire('student-projects', ['currentPage' => $currentPage, 'currentSearch' => $currentSearch]);
</form>

@endsection