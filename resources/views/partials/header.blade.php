<header class="header">
    <section class="extras">
        <nav class="container extras-items">
            <a href="https://laravel.com/" target="_blank" rel="nofollow">Laravel</a>
            <a href="https://laravel-idea.com" target="_blank" rel="nofollow">Laravel IDEA</a>
            <a href="https://sleepingowladmin.ru/" target="_blank" rel="nofollow">SleepingOwl</a>
            <a href="https://orchid.software/ru/" target="_blank" rel="nofollow">Orchid</a>
            <a href="https://vk.com/laravel_rus" target="_blank" rel="nofollow">Сообщество</a>
            <a href="https://discord.gg/c8gJfed" target="_blank" rel="nofollow">Discord</a>
            <a href="https://t.me/laravelrus" target="_blank" rel="nofollow">Telegram</a>
            <a href="https://github.com/LaravelRUS" target="_blank" rel="nofollow">GitHub</a>
        </nav>
    </section>

    <section class="menu">
        <section class="container menu-content">
            <a href="{{ route('home') }}" class="logo">
                <h1>{{ config('app.name') }}</h1>
            </a>

            <aside class="menu-aside">
                {{--<section class="menu-search">
                    <input type="text" class="menu-search-input" placeholder="Поиск по документации" />
                    <a href="#" class="button menu-search-button">Искать</a>
                </section>--}}

                <nav class="menu-items">
                    <a href="{{ route('home') }}" class="@active('home')">Главная</a>
                    <a href="{{ route('docs') }}" class="@active('docs.*')">Документация</a>
                    <a href="{{ route('status') }}" class="@active('status.*')">Перевод</a>
                    <span>Статьи</span>
                    <span>Пакеты</span>
                </nav>
            </aside>
        </section>
    </section>
</header>
