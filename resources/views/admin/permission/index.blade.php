@extends('admin.layouts.master')
@section('page-title')
Permission 
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
            <h3 class="card-title"> Permission</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if($permissions)
            <table  class="table table-bordered table-striped example2">
              {{-- @if($permissions->isEmpty()) --}}
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#content"><i class="fas fa-plus"></i> Permission</button>
              {{-- @endif --}}
              {{-- <a href="{{route('permission.create')}}">
                <button class="btn btn-info"><i class="fas fa-plus"></i> Add Permission</button>
              </a> --}}
              <thead>
              <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Manage</th>
              </tr>
              </thead>
              <tbody>
              @foreach($permissions as $permission)                        
              <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->slug }}</td>
                <td>
                  <form method="post" action="{{route('permission.destroy', $permission->id)}}">
                    @csrf
                    {{ method_field('delete') }}
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#content-{{$permission->id}}"><i class="fas fa-edit"></i></button>

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
    <form action="{{route('permission.store')}}" method="POST">
    @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Permission</h4>
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
@foreach($permissions as $permission)
<div class="modal fade" id="content-{{$permission->id}}">
  <div class="modal-dialog content-{{$permission->id}}">
    <form action="{{route('permission.update', $permission->id)}}" method="POST">
    @csrf
    {{method_field('put')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Permission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
              <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$permission->name}}" required>
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

{{-- Permission END  --}}
@endsection