<div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
    <div class="list-group list-group-flush">
        <a href="#"
            class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>

        @foreach(auth()->user()->notifications()->get() as $notification)
        <a href="#" class="list-group-item list-group-item-action border-bottom">
            <div class="row align-items-center">
                <div class="col-auto">
                    <!-- Avatar -->
                    <img alt="Image placeholder" src="{{$notification->data['photo']}}"
                        class="avatar-md rounded">
                </div>
                <div class="col ps-0 ms-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="h6 mb-0 text-small">{{$notification->data['title']}}</h4>
                        </div>
                        <div class="text-end">
                            <small class="text-danger">{{$notification->created_at->format('F d, Y')}}</small>
                        </div>
                    </div>
                    <p class="font-small mt-1 mb-0">
                        {{$notification->data['content']}}
                    </p>
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
