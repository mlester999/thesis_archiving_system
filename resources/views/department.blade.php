@extends('master')
@section('user')

<form action="{{ url('department', strtolower($currentPage)) }}" method="get" onkeydown="return event.key != 'Enter';">  
  @livewire('student-departments', ['currentPage' => $currentPage, 'currentSearch' => $currentSearch, 'currentDeptId' => $currentDeptId]);
</form>

@endsection