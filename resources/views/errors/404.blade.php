<x-xavi-layout>




<div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
        <div class="notfound-404">
            <h1>{{ __('errors.error404') }}</h1>
        </div>
        <h2>{{ __('errors.message404') }}</h2>
        <a href="/" class="home-btn">{{ __('errors.home') }}</a>
        <a href="/contact" class="contact-btn">{{ __('errors.contact') }}</a>
        current locale - {{App::currentLocale()}}
        <br />
        get locale - {{App::getLocale()}}
        <br />
        session {{var_dump(session()->all())}}
{{-- <h2>{{ $exception->getMessage() }}</h2> --}}
    </div>
    
</div>



</x-xavi-layout>