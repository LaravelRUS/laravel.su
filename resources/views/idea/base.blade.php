@extends('layout')

@section('content')
    <x-header image="/img/ui/crane-h.svg">
        <x-slot:sup>Среда разработки</x-slot>
            <x-slot:title>
                Laravel Idea
                </x-slot>

                <x-slot:description>
                    Полезные дополнения для IDE, включая генерацию кода, автодополнение синтаксиса
                    Eloquent, автодополнение правил валидации и многое другое.
                    </x-slot>

                    <x-slot:actions>
                        <a href="https://laravel-idea.com/" class="btn btn-primary btn-lg px-4">Перейти на сайт</a>
                        <a href="https://plugins.jetbrains.com/plugin/13441-laravel-idea"
                           class="link-body-emphasis text-decoration-none icon-link icon-link-hover">Маркетплейс
                            <x-icon path="bs.arrow-right" />
                        </a>
                        </x-slot>
    </x-header>


    <x-container>

        <div class="p-4 p-xxl-5 bg-body-tertiary rounded-3 position-relative mb-4">
            <div class="row g-5">
                <div class="col-xl">
                    <div class="d-none d-xl-flex row row-cols-1 row-cols-sm-1 g-4">
                        <div class="col d-flex flex-column gap-2">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div
                                        class="feature-icon-small d-inline-flex align-items-center justify-content-center border border-primary text-primary fs-4 rounded-3">
                                        <x-icon path="i.idea1"/>
                                    </div>
                                </div>
                                <h4 class="fw-semibold mb-0 text-body-emphasis">Генерация кода</h4>
                            </div>
                            <p class="text-body-secondary">
                                Мощная настраиваемая генерация кода для Laravel, автозаполнение полей и завершение отношений.
                            </p>
                        </div>
                        <div class="col d-flex flex-column gap-2">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div
                                        class="feature-icon-small d-inline-flex align-items-center justify-content-center border border-primary text-primary fs-4 rounded-3">
                                        <x-icon path="i.idea2"/>
                                    </div>
                                </div>
                                <h4 class="fw-semibold mb-0 text-body-emphasis">Eloquent завершение</h4>
                            </div>
                            <p class="text-body-secondary">
                                Полное автозаполнение полей и отношений, автоматическое создание фабрики ресурсов и баз данных JSON.
                            </p>
                        </div>
                        <div class="col d-flex flex-column gap-2">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div
                                        class="feature-icon-small d-inline-flex align-items-center justify-content-center border border-primary text-primary fs-4 rounded-3">
                                        <x-icon path="i.idea3"/>
                                    </div>
                                </div>
                                <h4 class="fw-semibold mb-0 text-body-emphasis">Полезные помощники</h4>
                            </div>
                            <p class="text-body-secondary">
                                Сотни полезных помощников, включая маршруты, валидацию, настройки и переводы, завершение имен шлюзов, поддержка Blade и многое другое.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    @yield('col')

                </div>
            </div>
        </div>

    </x-container>
@endsection
