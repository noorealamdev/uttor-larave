@extends('backend.layouts.base')
@section('content')

    @include('backend.partials.alert')
    <div class="section-body">
        <div class="d-flex mb-2 justify-content-between">
            <h4>Edit Course</h4>
        </div>

        <form action="{{ route('course.update', $course->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-9 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Course Title <span class="field-required">*</span></label>
                                <input class="form-control" type="text" name="title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="summernote form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sale Price (in TAKA) <span
                                        class="field-required">*</span></label>
                                <input class="form-control" type="text" name="sale_price" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Regular Price (in TAKA)</label>
                                <input class="form-control" type="text" name="regular_price">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Course Features (one per line)</label>
                                <textarea name="features" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Course Instructions</label>
                                <textarea name="instructions" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Course Total Duration (5.40 Hours)</label>
                                <input class="form-control" type="text" name="course_duration">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Course Preview Video</label>
                                <input class="form-control" type="text" name="video_preview">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Students Count</label>
                                <input class="form-control" type="text" name="students_count">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Course Status</label>
                                <select class="form-control form-select" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 waves-effect justify-content-center width-per-100">Publish</button>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Select Category <span class="field-required">*</span></label>
                                <select class="form-control form-select" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Select Teacher <span class="field-required">*</span></label>
                                <select class="form-control form-select" name="teacher_id">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Featured Image</label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>


        <div style="margin-top: 30px "></div>
        <div class="d-flex mb-2 justify-content-between">
            <h4>Add Course Lessons</h4>
        </div>
        <form action="{{ route('lesson.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Lesson Title <span class="field-required">*</span></label>
                                <input class="form-control" type="text" name="title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Video Url</label>
                                <input class="form-control" type="text" name="video_url">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Lesson Playback Time (40 Minutes)</label>
                                <input class="form-control" type="text" name="playback_time">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="enable_preview" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Enable Preview</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 waves-effect justify-content-center width-per-100">Publish</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection


@push('script')
    <script>
        $('document').ready(function () {
            $('.summernote').summernote();
        });
    </script>
@endpush
