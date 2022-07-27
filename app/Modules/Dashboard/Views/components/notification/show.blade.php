@extends('Dashboard::layouts.app')
@section('content')
    <div id="notifications">

        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notifications Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" target="_blank"
                href="{{ route('notification.show', $notification->id) }}">
                <div>
                    <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y h:i A') }}</div>
                    <span
                        class="@if ($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{ $notification->data['title'] }}</span>
                </div>
            </a>


            <a class="dropdown-item text-center small text-gray-500" href="{{ route('notification.index') }}">
                Show All Notifications
            </a>
        </div>
    </div>
@endsection
