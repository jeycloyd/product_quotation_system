@extends('layouts.master')
@section('title', 'View Users')
@section('scripts')
@section('content')
@section('header','View Users')
  <div class="table-wrapper">
    @if (\Session::has('success'))
        <div class="alert alert-success">
              {!! \Session::get('success') !!}
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger">
              {!! \Session::get('error') !!}
        </div>
    @endif
      {{-- <form action="{{route('search.products')}}" method="GET">
        <div class="input-group mb-3">
            @csrf
            <input type="text" class="form-control" placeholder="Search..." name="search">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
      </form>   --}}
      <table class="table table-hover" >
          <thead>
            <tr>
                <th scope="col">User ID</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Created At</th>
              <th scope="col">Role</th>
              <th scope="col">Approval Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
                  <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->created_at}}</td>
                      <td>{{$user->role}}</td>
                      <td {{$user->approval_status == 'Approved' ? 'style=color:green' : 'style=color:yellow'}} >{{$user->approval_status}}</td>
                      <td>
                        <button class="btn btn-success" {{$user->approval_status == 'Approved' ? 'style=display:none' : ''}} data-id="{{$user->id}}" data-target="#approveRegistrationModal" data-toggle="modal">Approve</button>
                        <button class="btn btn-danger" {{$user->approval_status == 'Approved' ? 'style=display:none' : ''}} data-id="{{$user->id}}" data-target="#disapproveRegistrationModal" data-toggle="modal">Disapprove</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal" data-id="{{$user->id}}">Change Role</button>
                      </td>
                  </tr>    
              @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $users->withQueryString()->links() }}
        </div>
  </div>
  <!---------------------------------- POP UP MODAL FOR CONFIRM CHANGE ROLE----------------------------------------------------->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Change Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to change the user's role?
          <form action="{{route('update.users')}}" method="GET">
            @csrf
            <input hidden type="text" name="id" class="form-control" id="id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Yes, Change Role</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------- POP UP MODAL for Approve registration----------------------------------------------------->
  <div class="modal fade" id="approveRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="approveRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Approve User Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Before approving, please select the user's role.
          <form action="{{route('approve.users')}}" method="GET">
            @csrf
            <input type="text" hidden id="input_user_id" name="user_id">
            <label for="user_role">User Role:</label>
            <select required name="user_role" id="input_user_role">
              <option value="viewer">Viewer</option>
              <option value="admin">Admin</option>  
            </select>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Yes, Approve User</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------- POP UP MODAL for Disapprove registration----------------------------------------------------->
  <div class="modal fade" id="disapproveRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="disapproveRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Approve User Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Disapprove this user's registration?
          <form action="{{route('disapprove.users')}}" method="GET">
            @csrf
            <input type="text" hidden id="input_disapprove_user_id" name="user_id">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Yes, Disapprove User</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<script src="{{ asset('js/modals.js') }}"></script>
@endsection