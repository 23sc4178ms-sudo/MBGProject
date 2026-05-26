@extends('format.layout')

@section('title','Student Page')

@section('content')

<h1 class="mb-4">Students List</h1>

<table class="table table-bordered">

<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Age</th>
<th>Course</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@foreach($students as $index => $student)

<tr>

<td>{{ $index + 1 }}</td>
<td>{{ $student['name'] }}</td>
<td>{{ $student['age'] }}</td>
<td>{{ $student['course'] }}</td>

<td>

@if($student['age'] == 19)
Freshman Student

@elseif($student['age'] == 20)
Sophomore Student

@elseif($student['age'] == 21)
Junior Student

@elseif($student['age'] == 22)
Senior Student

@else
Regular Student

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

@endsection