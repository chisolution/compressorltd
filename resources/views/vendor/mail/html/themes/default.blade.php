@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
@if(\App\Services\CompanyInfoService::logo())
<img src="{{ asset('storage/' . \App\Services\CompanyInfoService::logo()) }}" 
     alt="{{ \App\Services\CompanyInfoService::name() }}" 
     style="max-height: 50px;">
@else
{{ \App\Services\CompanyInfoService::name() }}
@endif
@endcomponent
@endslot

{{-- Body --}}
{{ $slot ?? '' }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ \App\Services\CompanyInfoService::name() }}
@if(\App\Services\CompanyInfoService::tagline())
<br>{{ \App\Services\CompanyInfoService::tagline() }}
@endif

@if(\App\Services\CompanyInfoService::phone() || \App\Services\CompanyInfoService::email())
<div style="margin-top: 10px;">
@if(\App\Services\CompanyInfoService::phone())
Tel: {{ \App\Services\CompanyInfoService::phone() }}<br>
@endif
@if(\App\Services\CompanyInfoService::email())
Email: {{ \App\Services\CompanyInfoService::email() }}
@endif
</div>
@endif

@if(\App\Services\CompanyInfoService::address())
<div style="margin-top: 10px;">
{{ \App\Services\CompanyInfoService::address() }}
</div>
@endif
@endcomponent
@endslot
@endcomponent
