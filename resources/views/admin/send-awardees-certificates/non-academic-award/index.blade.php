@extends('layouts.admin')

@section('title', 'Send Non Academic Award Certificate')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Non Academic Award - Send Certificates</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        @foreach ($nonacad as $item)
            <div class="col-lg-3 mb-3 d-flex align-items-stretch">
                <a class="card lift border-left-secondary w-100"
                    href="{{ url('admin/send-awardees-certificates/non-academic-award/' . $item->id) }}">
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="card-text font-weight-bold text-secondary text-uppercase">
                                {{ $item->name }}
                            </div>
                            @if ($item->applicant_count > '0')
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger rounded-circle">{{ $item->applicant_count }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
