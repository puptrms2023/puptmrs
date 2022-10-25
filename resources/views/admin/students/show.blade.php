@extends('layouts.admin')

@section('title', 'View Students')

@section('content')

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-primary font-weight-bold">
                        STUDENT INFORMATION
                        <a href="{{ url('admin/students') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="small text-muted">STUDENT NUMBER:</label>
                                <input type="text" class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->stud_num }}" disabled>
                            </div>
                            <div class="col">
                                <label class="small text-muted">USERNAME:</label>
                                <input type="text" class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->username }}" disabled>
                            </div>
                            <div class="col">
                                <label class="small text-muted">FIRST NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->first_name }}" disabled />
                            </div>
                            <div class="col">
                                <label class="small text-muted">MIDDLE NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->middle_name ?: 'N/A' }}" disabled />
                            </div>
                            <div class="col">
                                <label class="small text-muted">LAST NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->last_name }}" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="small text-muted">COURSE:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->courses->course }}" disabled />
                            </div>
                            <div class="col-2">
                                <label class="small text-muted">PHONE</label>
                                <input class="form-control font-weight-bold" value="{{ $students->contact }}" disabled />
                            </div>
                            <div class="col-4">
                                <label class="small text-muted">EMAIL:</label>
                                <input class="form-control font-weight-bold text-uppercase" value="{{ $students->email }}"
                                    disabled />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($academic->count() > 0)
        <div class="row mt-4 mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Award Applied</th>
                                        <th>Year Level</th>
                                        <th>First Sem GWA</th>
                                        <th>Second Sem GWA</th>
                                        <th>Average</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-uppercase">
                                    @foreach ($academic as $app)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><span class="badge badge-info">{{ $app->award->name }}</span></td>
                                            <td>{{ $app->year_level }}</td>
                                            <td class="text-center">{{ $app->gwa_1st }}</td>
                                            <td class="text-center">{{ $app->gwa_2nd }}</td>
                                            <td class="text-center">{{ $app->gwa }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/' . $app->image) }}"
                                                    class="img-thumbnail img-circle" width="50" alt="Image">
                                            </td>
                                            <td>
                                                @if ($app->status == '0')
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if ($app->status == '1')
                                                    <span class="badge badge-success">Approved</span>
                                                @endif
                                                @if ($app->status == '2')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($app->created_at)->format('m/d/Y g:i a') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $academic->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif

    @if ($excellence->count() > 0)
        <div class="row mt-4 mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Award Applied</th>
                                        <th>Year Level</th>
                                        <th>1st year</th>
                                        <th>2nd year</th>
                                        <th>3rd year</th>
                                        <th>4th year</th>
                                        <th>Average</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-uppercase">
                                    @php
                                        $gwa_1st = 0.0;
                                        $gwa_2nd = 0.0;
                                        $gwa_3rd = 0.0;
                                        $gwa_4th = 0.0;
                                    @endphp
                                    @foreach ($excellence as $app)
                                        @php
                                            $gwa_1st = ($app->gwa1 + $app->gwa2) / 2;
                                            $gwa_2nd = ($app->gwa3 + $app->gwa4) / 2;
                                            $gwa_3rd = ($app->gwa5 + $app->gwa6) / 2;
                                            $gwa_4th = ($app->gwa7 + $app->gwa8) / 2;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><span class="badge badge-success">{{ $app->award->name }}</span></td>
                                            <td>{{ $app->year_level }}</td>
                                            <td class="text-center">{{ $gwa_1st }}</td>
                                            <td class="text-center">{{ $gwa_2nd }}</td>
                                            <td class="text-center">{{ $gwa_3rd }}</td>
                                            <td class="text-center">{{ $gwa_4th }}</td>
                                            <td class="text-center">{{ $app->gwa }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/' . $app->image) }}"
                                                    class="img-thumbnail img-circle" width="50" alt="Image">
                                            </td>
                                            <td>
                                                @if ($app->status == '0')
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if ($app->status == '1')
                                                    <span class="badge badge-success">Approved</span>
                                                @endif
                                                @if ($app->status == '2')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($app->created_at)->format('m/d/Y g:i a') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $excellence->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif

    @if ($non_acad->count() > 0)
        <div class="row mt-4 mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Award Applied</th>
                                        <th>Year Level</th>
                                        <th>Image</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-uppercase">
                                    @foreach ($non_acad as $app)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($app->nonacad_id == '1')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>School Organization: {{ $app->orgs->name }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '2')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>Sport: {{ $app->sports }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '3')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>School Organization: {{ $app->orgs->name }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '4')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>Subject Name: {{ $app->subject_name }}<br>
                                                            Thesis Title: {{ $app->thesis_title }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '5')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>School Organization: {{ $app->orgs->name }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '6')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>Designation Office: {{ $app->designated_office }}<br>
                                                            School Organization: {{ $app->orgs->name }}</p>
                                                    </div>
                                                @elseif ($app->nonacad_id == '7')
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                    <div class="small">
                                                        <P>Competition Name: {{ $app->competition_name }}<br>
                                                            Placements: {{ $app->placement }}<br>
                                                            School Organization: {{ $app->orgs->name }}</p>
                                                    </div>
                                                @else
                                                    <span class="badge badge-primary">{{ $app->nonacad->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $app->year_level }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/' . $app->image) }}"
                                                    class="img-thumbnail img-circle" width="50" alt="Image">
                                            </td>
                                            <td>{{ $app->remarks }}</td>
                                            <td>
                                                @if ($app->status == '0')
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if ($app->status == '1')
                                                    <span class="badge badge-success">Approved</span>
                                                @endif
                                                @if ($app->status == '2')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($app->created_at)->format('m/d/Y g:i a') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                {!! $non_acad->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif

@endsection
