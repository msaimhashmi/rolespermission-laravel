@extends('admin.layouts.master')
@section('page-title')
Roles 
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    {{-- <x-alert/> --}}
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Roles</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if($roles)
            <table  class="table table-bordered table-striped example2">
              {{-- @if($roles->isEmpty()) --}}
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#content"><i class="fas fa-plus"></i> Roles</button>
              {{-- @endif --}}
              {{-- <a href="{{route('Roles.create')}}">
                <button class="btn btn-info"><i class="fas fa-plus"></i> Add Roles</button>
              </a> --}}
              <thead>
              <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Manage</th>
              </tr>
              </thead>
              <tbody>
              @foreach($roles as $role)                        
              <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->slug }}</td>
                <td>
                  <form method="post" action="{{route('role.destroy', $role->id)}}">
                    @csrf
                    {{ method_field('delete') }}
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#content-{{$role->id}}"><i class="fas fa-edit"></i></button>

                    <button onclick="return confirm('Are you sure to want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>   
              @endforeach
              </tbody>
            </table>
            @else
            <div class="alert alert-danger"> 
              No Record Found!
            </div>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
    <!-- /.content -->

{{-- CREATE --}}
<div class="modal fade" id="content">
  <div class="modal-dialog content">
    <form action="{{route('role.store')}}" method="POST">
    @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Roles</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
              <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="name" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
              <label>Permissions</label>
              <br>
                @foreach($permissions as $value)
                  <input type="checkbox" id="{{$value->id}}" name="permission[]" value="{{$value->id}}">
                  <label for="{{$value->id}}"> {{$value->name}}</label><br>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
    <!-- /.modal-dialog -->
</div>
{{-- CREATE --}}

{{-- EDIT --}}
@foreach($roles as $role) 
<div class="modal fade" id="content-{{$role->id}}">
  <div class="modal-dialog content-{{$role->id}}">
    <form action="{{route('role.update', $role->id)}}" method="POST">
    @csrf
    {{method_field('put')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Roles</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
              <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$role->name}}" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

{{-- Roles END  --}}
@endsection