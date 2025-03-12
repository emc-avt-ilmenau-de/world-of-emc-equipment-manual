@extends('FrontEnd.layouts.main')
@section('main-container')


<h1>{{ __('messages.about-content') }}</h1>

<ul>
    @foreach(trans('messages.about-content1') as $item)
    <li>{{ $item }}</li>
    @endforeach
</ul>

<h2>{{ __('messages.Impressum') }}</h2>

@foreach(trans('messages.impressum') as $item)
<li>{{ $item }}</li>
@endforeach


<h2>{{ __('messages.Copyright') }}</h2>
<p>{{ __('messages.copyright') }}</p>

<h2>{{ __('messages.Conditions_of_use') }}</h2>
<p>{{ __('messages.conditions-of-use') }}</p>



@endsection