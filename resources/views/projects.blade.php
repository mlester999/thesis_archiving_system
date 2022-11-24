@extends('master')
@section('user')

<form action="{{ url('projects') }}" method="get" onkeydown="return event.key != 'Enter';">  
  @livewire('student-projects', ['currentPage' => $currentPage, 'currentSearch' => $currentSearch]);
</form>

@endsection