@if (auth()->user()->can('presidents list edit'))
    @if ($data->status == '1')
        <span class="badge badge-success">Approved</span>
    @elseif ($data->status == '2')
        <span class="badge badge-danger">Rejected</span>
        <div class="small">
            @if (!empty($data->reason))
                @if ($data->reason == '1')
                    Others: {{ $data->others }}
                @else
                    {{ $data->reasons->description }}
                @endif
            @endif
        </div>
    @else
        <a href="{{ url('admin/presidents-list-award/' . $data->courses->course_code . '/approve/' . $data->id) }}"
            class="btn btn-success btn-sm btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Approve</span>
        </a>
        <a href="{{ url('admin/presidents-list-award/' . $data->courses->course_code . '/reject/' . $data->id) }}"
            class="btn btn-danger btn-sm btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa-sharp fa-solid fa-xmark"></i>
            </span>
            <span class="text">Reject</span>
        </a>
    @endif
@else
    @if ($data->status == '1')
        <span class="badge badge-success">Approved</span>
    @elseif ($data->status == '2')
        <span class="badge badge-danger">Rejected</span>
        <div class="small">
            @if (!empty($data->reason))
                @if ($data->reason == '1')
                    Others: {{ $data->others }}
                @else
                    {{ $data->reasons->description }}
                @endif
            @endif
        </div>
    @else
        <span class="badge badge-warning">Pending</span>
    @endif
@endif
