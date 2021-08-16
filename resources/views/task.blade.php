@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="text-center">
        <h2>Create Task</h2>
        <br>
        <form action="{{route('task.store')}}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
            <br>
            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
            <br>
            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
</div>
@endsection