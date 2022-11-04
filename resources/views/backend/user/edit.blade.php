@extends('backend.layouts.base')
@include('backend.partials.alert')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
    <h3>Edit Teacher</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="form-label">User Type <span class="field-required">*</span></label>
                            <select class="form-control form-select" name="type">
                                <option value="teacher" {{ $user->type == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">User Name <span class="field-required">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">User Phone Number <span class="field-required">*</span></label>
                            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">About</label>
                            <textarea class="form-control" name="about">{{ $user->about }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>User Image</label>
                            <input type="file" class="form-control" name="avatar">
                            @if(!empty($user->avatar))
                                <img class="mt-2" src="{{ asset('uploads/'. $user->avatar) }}" alt="" width="230" height="150">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password <span class="field-required">*</span></label>
                            <input class="form-control" type="password" name="password" value="{{ $user->password }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 waves-effect">Update</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
