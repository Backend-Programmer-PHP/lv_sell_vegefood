@extends('Dashboard::layouts.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('notification.index') }}">Notification</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Components</li>
                </ol>
            </nav>
            <h2 class="h4">All Notification</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>

    </div>
    {{-- Table --}}
    @include('Dashboard::partials._notifications')
    @if (count(Auth::user()->Notifications) > 0)
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="border-gray-200">#</th>
                        <th class="border-gray-200">Time</th>
                        <th class="border-gray-200">Title</th>
                        <th class="border-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->Notifications as $notification)
                        <tr>
                            <td>
                                <a href="#" class="fw-bold">
                                    {{ $loop->index + 1 }}
                                </a>
                            </td>
                            <td>
                                <span
                                    class="fw-normal">{{ $notification->created_at->format('F d, Y h:i A') }}</span>
                            </td>
                            <td>
                                <span class="fw-normal">{{ $notification->data['title'] }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu py-0">
                                        <a class="dropdown-item rounded-top" href="{{ route('notification.show', $notification->id) }}"><span
                                                class="fas fa-eye me-2"></span>View
                                            Details</a>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu py-0">
                                        <form method="POST" action="{{ route('notification.delete', $notification->id) }}">
                                            @csrf
                                            <button class="dropdown-item text-danger rounded-bottom dltBtn"
                                                data-id={{ $notification->id }} data-toggle="tooltip"
                                                data-placement="bottom">
                                                <span class="fas fa-trash-alt me-2"></span>
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    @else
        <h2>The message is not available.!!</h2>
    @endif
@endsection
@push('styles')
    <style>
        button.close {
            border-radius: 50px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 5px;
        }

    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        // Ẩn hiện thông báo
        $(document).ready(function() {
            $("button").click(function() {
                $(".alert.alert-danger.alert-dismissable.fade.show").remove();
                $(".alert.alert-success.alert-dismissable.fade.show").remove();
            });
        });
        // Modal Xóa thể loại
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        });
    </script>
@endpush
