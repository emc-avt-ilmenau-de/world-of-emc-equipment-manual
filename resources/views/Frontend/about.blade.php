@extends('Frontend.layouts.main')
@section('main-container')


<div id="white-bg-wrapper">
    <div class="content-container">
        <!-- Navigation Tabs -->
        <nav class="tab-menu">
            <ul>
                <li class="tab-link active" data-target="about-content">{{ __('messages.about-content') }}</li>
                <li class="tab-link" data-target="impressum">{{ __('messages.Impressum') }}</li>
                <li class="tab-link" data-target="copyright1">{{ __('messages.Copyright') }}</li>
                <li class="tab-link" data-target="conditions-of-use">{{ __('messages.Conditions_of_use') }}</li>
            </ul>
        </nav>

        <!-- Content Sections -->
        <div id="about-content" class="tab-content active">
            <h1 class="section-title">{{ __('messages.about-content') }}</h1>
            <ul class="styled-list1">
                @foreach(trans('messages.about-content1') as $line)
                <li> {!! $line !!}<br></li>
                @endforeach
            </ul>
        </div>

        <div id="impressum" class="tab-content">
            <h2 class="section-subtitle">{{ __('messages.Impressum') }}</h2>
            <ul class="styled-list">
                @foreach(__('messages.impressum') as $line)
                {!! $line !!}<br>
                @endforeach
            </ul>
        </div>

        <div id="copyright1" class="tab-content">
            <h2 class="section-subtitle">{{ __('messages.Copyright') }}</h2>
            <p class="section-text">{{ __('messages.copyright1') }}</p>
        </div>

        <div id="conditions-of-use" class="tab-content">
            <h2 class="section-subtitle">{{ __('messages.Conditions_of_use') }}</h2>
            <p class="section-text">{!! __('messages.conditions-of-use') !!}
            </p>
        </div>
    </div>
</div>



@endsection
