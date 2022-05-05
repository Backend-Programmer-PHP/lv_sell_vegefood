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
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Components</li>
                </ol>
            </nav>
            <h2 class="h4">All Categories</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('category.add') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Category
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
    </div>
    {{-- New --}}
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <form id="idForm" action="{{ route('category.search') }}" method="get">
                        @csrf
                        <input type="text" class="form-control" name="keyword" placeholder="Search category">
                    </form>
                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10
                            <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Table --}}
    @include('Dashboard::partials._notifications')
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-gray-200">#</th>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Issue Date</th>
                    <th class="border-gray-200">Due Date</th>
                    <th class="border-gray-200">Status</th>
                    <th class="border-gray-200">Action</th>
                </tr>
            </thead>
            @if ($categories)
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <a href="#" class="fw-bold">
                                    {{ $category->id }}
                                </a>
                            </td>
                            <td>
                                <span class="fw-normal">{{ $category->name }}</span>
                            </td>
                            <td><span class="fw-normal">{{ date_format($category->created_at, 'd F Y') }}</span></td>
                            <td><span class="fw-normal">{{ date_format($category->updated_at, 'd F Y') }}</span></td>
                            @if ($category->status == 'active')
                                <td><span class="fw-bold text-success">Paid</span></td>
                            @else
                                <td><span class="fw-bold text-danger">Cancelled</span></td>
                            @endif
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
                                        <a class="dropdown-item rounded-top" href="#"><span
                                                class="fas fa-eye me-2"></span>View
                                            Details</a>
                                        <a class="dropdown-item"
                                            href="{{ route('category.edit', $category->slug) }}"><span
                                                class="fas fa-edit me-2"></span>Edit</a>
                                        <form method="POST" action="{{ route('category.delete', $category->id) }}">
                                            @csrf
                                            <button class="dropdown-item text-danger rounded-bottom dltBtn"
                                                data-id={{ $category->id }} data-toggle="tooltip" data-placement="bottom">
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
            @else
                <tbody></tbody>
            @endif
        </table>
        @php
            //dd($categories->total());
            $pagePrevious = $categories->currentPage() - 1;
            $pageNext = $categories->currentPage() + 1;
            $total_pages = ceil($categories->total() / $categories->perPage());
            // dd($total_pages);
        @endphp
        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    @if ($categories->currentPage() > 1 && $categories->total() > 1)
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ url('/categories') }}?page={{ $pagePrevious }}">Previous</a>
                        </li>
                    @endif
                    @for ($i = 1; $i <= $total_pages; $i++)
                        @if ($i == $categories->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="{{ url('/categories') }}?page={{ $i }}">
                                    {{ $i }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ url('/categories') }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    @if ($categories->currentPage() < $categories->total() && $categories->total() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ url('/categories') }}?page={{ $pageNext }}">Next</a>
                        </li>
                    @endif
                </ul>

            </nav>

            <div class="fw-normal small mt-4 mt-lg-0">Showing <b>{{ $categories->perPage() }}</b> out of
                <b>{{ $categories->total() }}</b> entries
            </div>
        </div>
    </div>
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
    <script type="text/javascript">
        // Tìm kiểm thể loại xử lý ajax
        $(document).ready(function() {
            $("#idForm2").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>
@endpush
