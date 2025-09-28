@props(['width' => 100 ])


<img {{ $attributes->merge(['width' => $width.'%']) }} src="{{asset('img/logo.png') }}">