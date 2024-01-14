@extends('layout')

@section('content')
    <x-container>
        <div class="col-xl-6 col-lg-8 col-md-12 mx-auto">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <h4 class="fw-bold mb-0 text-body-emphasis">
                    Уведомления
                </h4>
                <a href="{{route('profile.notifications.read.all')}}"
                   data-turbo-method="post"
                   class="link-primary fw-semibold text-decoration-none text-end">
                    Пометить все как прочитанные
                </a>
            </div>
            <div class="bg-body-tertiary rounded overflow-hidden mb-4 p-4 p-xl-5">

                @if($notifications->isEmpty())
                    <div class="p-md-5">
                        <div class="text-center mb-3">
                            Нет уведомлений
                        </div>
                    </div>
                @else
                    <div class="d-flex flex-column">
                        @foreach($notifications as $notification)
                            <div id="@domid($notification)"
                                 @class([
                                     'list-group-item',
                                     'rounded',
                                     'hotwire-frame',
                                     'p-3',
                                     'mb-3' => !$loop->last,
                                     'bg-body-secondary' => $notification->read(),
                                     'text-muted' => $notification->read(),
                                 ])>

                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-3">
                                        @isset($notification->data['img'])
                                            <img class="avatar-img rounded-circle" src="{{$notification->data['img']}}">
                                        @else
                                            <img class="avatar-img rounded-circle" src="{{ asset('img/notification_logo.svg') }}">
                                        @endif
                                    </div>
                                    <div>
                                        @if(isset($notification->data['type'] ) && $notification->data['type'] == \App\Casts\NotificationTypeEnum::ReplyComment->value)
                                            <span class="fw-semibold">{{$notification->data['author']}}</span>
                                            {{$notification->data['title']}}
                                            @isset($notification->data['action'])
                                                <a class="link-body-emphasis stretched-link fw-semibold text-decoration-none"
                                                   href="{{route('profile.notifications.read',$notification)}}">
                                                    @isset($notification->data['action_text'])
                                                        {{$notification->data['action_text'] }}
                                                    @else
                                                        Перейти
                                                    @endif
                                                </a>
                                            @endif
                                        @else
                                            {{$notification->data['title']}}
                                            @isset($notification->data['action'])
                                                <a class="link-body-emphasis stretched-link fw-semibold text-decoration-none text-primary"
                                                   href="{{route('profile.notifications.read',$notification)}}">
                                                    @isset($notification->data['action_text'])
                                                        {{$notification->data['action_text'] }}
                                                    @else
                                                        Перейти
                                                    @endif
                                                </a>
                                            @endif

                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif


            </div>

            @if($notifications->isNotEmpty())
                {{ $notifications->links() }}
            @endif
        </div>
    </x-container>
@endsection