@extends('backend.layouts.base')
@section('content')

    @include('backend.partials.alert')
    <div class="section-body">
        <div class="d-flex mb-2 justify-content-between">
            <h4>Add New User</h4>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">User Type <span class="field-required">*</span></label>
                                <select class="form-control form-select" name="type">
                                    <option value="teacher">Teacher</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Name <span class="field-required">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Phone Number <span class="field-required">*</span></label>
                                <input class="form-control" type="text" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">About</label>
                                <textarea class="form-control" name="about"></textarea>
                            </div>
                            <div class="form-group">
                                <label>User Image</label>
                                <input type="file" class="form-control" name="avatar">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password <span class="field-required">*</span></label>
                                <input class="form-control" type="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 waves-effect">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
