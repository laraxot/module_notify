@extends('adm_theme::layouts.app')
@section('content')
    usa theme notification con profilo con questa email
    <x-col size="12">
        <form action="{!! Request::fullUrlWithQuery([]) !!}" method="POST">
            @csrf
            <x-input.group type="text" name="email" />
            <x-button type="submit">go!</x-button>
        </form>
    </x-col>
@endsection
