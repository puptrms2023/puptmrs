@extends('layouts.user')

@section('title', 'Academic Excellence Status')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Non-Academic Award Status</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Status
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Award Applied</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $list)
                                    <tr>
                                        <td class="font-weight-bold">{{ $list->users->stud_num }}</td>
                                        <td>{{ $list->users->first_name }}</td>
                                        <td>{{ $list->users->last_name }}</td>
                                        <td>{{ $list->courses->course_code }}</td>
                                        <td>{{ $list->year_level }}</td>
                                        <td>
                                            @if ($list->nonacad_id == '1')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $list->orgs->name }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '2')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Sport: {{ $list->sports }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '3')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Sport: {{ $list->sports }}<br>
                                                        School Organization: {{ $list->orgs->name }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '4')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Subject Name: {{ $list->subject_name }}<br>
                                                        Thesis Title: {{ $list->thesis_title }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '5')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $list->orgs->name }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '6')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Designation Office: {{ $list->designated_office }}<br>
                                                        School Organization: {{ $list->orgs->name }}</p>
                                                </div>
                                            @elseif ($list->nonacad_id == '7')
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Competition Name: {{ $list->competition_name }}<br>
                                                        Placements: {{ $list->placement }}<br>
                                                        School Organization: {{ $list->orgs->name }}</p>
                                                </div>
                                            @else
                                                <span class="badge badge-primary">{{ $list->nonacad->name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $list->image) }}"
                                                class="img-thumbnail img-circle" width="50" alt="Image">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
