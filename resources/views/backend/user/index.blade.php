@extends('backend.layouts.base')
@section('content')

    @include('backend.partials.alert')

    <div class="section-body">
        <div class="d-flex mb-2">
            <h4>Users</h4>
            <a href="{{ route('user.create') }}" class="btn btn-success ml-3">Add New user</a>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($users)
                                <table id="basic-datatable" class="table table-striped dt-responsive w-100">
                                    <thead>
                                    <tr>
                                        <th>User Avatar</th>
                                        <th>user Name</th>
                                        <th>Phone Number</th>
                                        <th>User Type</th>
                                        <th>Joined</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @if(!empty($user->avatar))
                                                    <img src="{{ asset('uploads/'. $user->avatar) }}" alt=""
                                                         width="100" height="70">
                                                @else
                                                    no image
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn"
                                                   data-original-title="Edit">
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </a>
                                                <a href="#" class="btn tblDelBtn" data-toggle="modal"
                                                   data-target="#deleteModal{{ $user->id }}"
                                                   data-original-title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                        </tr> <!-- End single item -->

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="teamModalCenterTitle">Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center"><h5>Are you sure?</h5></div>
                                                    <div class="modal-footer">
                                                        <form class="d-inline-block"
                                                              action="{{ route('user.destroy', $user->id) }}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-success">Yes, delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4>No User Found</h4>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
