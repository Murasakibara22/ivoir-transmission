<div>
    <div class="tab-content position-relative" id="notificationItemsTabContent" wire:ignore>
        <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
            <div data-simplebar style="max-height: 300px;" class="pe-2">

                @if(auth()->user()->NotificationAdmin()->get() && auth()->user()->NotificationAdmin()->where('is_read', false)->count() > 0)
                @foreach (auth()->user()->NotificationAdmin()->where('is_read', false)->OrderBy('created_at', 'desc')->take(5)->get() as $item)
                    <div
                        class="text-reset notification-item d-block dropdown-item position-relative" wire:click="ShowNotif({{ $item->id }})">
                        <div class="d-flex">
                            <img  src="https://api.dicebear.com/8.x/identicon/svg?seed=true"
                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-1">
                                <a href="#!" class="stretched-link">
                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ $item->title }}</h6>
                                </a>
                                <div class="fs-13 text-muted">
                                    <p class="mb-1">{{ $item->subtitle }}🔔.</p>
                                </div>
                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                    <span><i class="mdi mdi-clock-outline"></i> {{ $item->created_at->diffForHumans() }}</span>
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
                @else
                    <div class="timeline-continue">
                        <div class="row timeline-right">
                            <div class="col-12">
                                <p class="timeline-date">
                                    Aucune Notification !
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="my-3 text-center view-all">
                    <button type="button" onclick="window.location.href='#'"
                        class="btn btn-soft-success waves-effect waves-light">Toutes les notifications <i
                            class="ri-arrow-right-line align-middle"></i></button>
                </div>
            </div>

        </div>
    </div>

</div>
