@extends('layouts.master')

@php
/**
 * @var \App\Entity\Version $version
 * @var \App\Entity\Documentation $page
 * @var \App\Entity\Documentation $menu
 */
@endphp

@section('title'){{ $page->title }} (Laravel {{ $version->name }})@stop
@section('description')Русская документация Laravel {{ $version->name }} - {{ $page->title }}@stop
@section('keywords'){{ $page->getKeywordsString() }}@stop

@push('header')
    @include('page.docs.partials.versions', ['version' => $version, 'page' => $page])
@endpush

@section('content')
    <section class="container documentation">
        <aside class="documentation-menu">
            {!! $menu !!}
        </aside>

        <article class="documentation-content">
            @if($page->version->name == '8.x')
            @include('page.docs.partials.translation-notification', ['page' => $page])
            @endif
            @include('page.docs.partials.translation-status', ['page' => $page])

            {!! $page !!}
        </article>
    </section>
@endsection
