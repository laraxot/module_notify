@extends('adm_theme::layouts.app')
@section('content')
    <x-navbar>
        @foreach ($drivers as $k => $v)
            <x-navbar.item href="{!! Request::fullUrlWithQuery(['i' => $k]) !!}" active="{{ $driver == $v ? 'active' : '' }}">
                {{ $v }}
            </x-navbar.item>
        @endforeach
    </x-navbar>


    @php
        //dddx([$content_selection_and_highlighting, $txt]);
    @endphp

    <x-col size="12">
        @if ($driver)
            <form action="{!! Request::fullUrlWithQuery([]) !!}" method="POST">

                @csrf
                <input type="text" name="driver" value="{{ $driver }}" />
                from: <input type="text" name="from" />
                to:<input type="text" name="to" value="3475896127" />

                txt:
                <textarea name="body"></textarea>

                <input type="submit" value="go!" />

            </form>
        @endif
        {{ $driver }}
    </x-col>
@endsection
