@extends('layout')
@section('type', "Документация")
@section('title', $docs->title())

@section('content')

    <x-container>
        <div class="row g-xxl-5 justify-content-center align-items-start position-relative mb-5">
            <div class="col-md-3 order-md-first order-last position-sticky top-0 py-md-3 z-1 d-none d-md-block doc-navigation">

                <div class="mb-md-4 d-flex align-items-stretch flex-column offcanvas-md offcanvas-start" id="docs-menu">

                    {{--
                    <input class="form-control form-control-lg" type="text" placeholder="Поиск по документации..."
                        aria-label=".form-control-lg example">
--}}

                    <div class="d-flex align-items-center p-4 p-sm-0">
                        <select class="form-select form-select-sm rounded-3" onchange="Turbo.visit(this.value);">
                            @foreach (\App\Docs::SUPPORT_VERSIONS as $version)
                                <option value="{{ route('docs', ['version' => $version]) }}" @selected(active(route('docs', ['version' => $version]).'*'))>{{ $version  }}</option>
                            @endforeach
                        </select>

                        @if($docs->behind() === null)
                            <a href="{{ route('status', $docs->version) }}#{{ $docs->file }}" class="mx-3 text-decoration-none text-secondary" title="Перевод не имеет метки">
                                ●
                            </a>
                        @elseif ($docs->behind() > 0)
                            <a href="{{ route('status', $docs->version) }}#{{ $docs->file }}" class="mx-3 text-decoration-none text-primary" title="Отстаёт на {{ $docs->behind() }} изменения">
                                ●
                            </a>
                        @else
                            <a href="{{ route('status', $docs->version) }}#{{ $docs->file }}" class="mx-3 text-decoration-none text-success" title="Перевод актуален">
                                ●
                            </a>
                        @endif

                        <a href="{{ $docs->goToOriginal() }}" title="Посмотреть оригинал" target="_blank"
                           class="link-body-emphasis text-decoration-none d-none d-md-block">
                            <x-icon path="i.translation" />
                        </a>
                    </div>

                    <ul class="list-unstyled p-4 px-md-0">
                        @foreach ($docs->getMenu() as $item)
                            <li class="mb-2">
                                <button
                                    class="btn btn-toggle d-flex align-items-center rounded border-0 collapsed text-body-secondary p-0 w-100 text-start"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ \Illuminate\Support\Str::slug($item['title']) }}-collapse"
                                    aria-expanded="true">
                                    {{ $item['title'] }}
                                </button>

                                <div class="collapse {{ active(collect($item['list'])->map(fn($link) => $link['href']), 'show') }} mt-2"
                                    id="{{ \Illuminate\Support\Str::slug($item['title']) }}-collapse"
                                    data-bs-parent="#docs-menu">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-2">
                                        @foreach ($item['list'] as $link)
                                            <li>
                                                <a href="{{ $link['href'] }}"
                                                    class="{{ active(url($link['href']), 'active', 'link-body-emphasis') }} d-inline-flex text-decoration-none rounded p-2">
                                                    {{ $link['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="bg-body-secondary rounded-3 py-5 px-4 text-center mt-auto d-none d-md-block">
                        <img src="/img/ui/pastbin.svg" alt="pastbin" class="w-auto mb-4" height="100">
                        <h6 class="mb-2">Делитесь вашим кодом в чате!</h6>
                        {{-- <h6>Посмотрите видео-уроки о том как сделать крутое приложение!</h6> --}}
                        <a class="btn w-100 btn-sm btn-primary" href="{{ route('pastebin') }}">Поделиться</a>
                    </div>
                </div>
            </div>
            <div class="px-0 px-md-2 px-xl-3 col-md-9 order-md-last order-first">

                <main class="bg-body-tertiary p-4 p-xl-5 rounded documentations position-relative" data-controller="prism2 shiki">
                    <h1 class="display-6 fw-bold text-body-emphasis mb-4">{{ $docs->title() }}</h1>
                    @if ($docs->isOlderVersion())
                        <div class="alert alert-warning rounded-2" role="alert">
                            <p class="mb-0">⚠️ Вы просматриваете документ для прошлой версии.</p>
                            Рассмотрите возможность обновления вашего проекта до актуальной версии <code>{{ \App\Docs::DEFAULT_VERSION }}</code>.
                        </div>
                    @endif

                    <x-docs.anchors :content="$content"/>
                    <x-docs.content :content="$content"/>
                </main>
            </div>
        </div>
    </x-container>
@endsection
