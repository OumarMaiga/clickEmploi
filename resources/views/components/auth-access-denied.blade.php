@props(['denied'])

@if ($denied)
    <div {{ $attributes->merge(['class' => 'font-medium text-md text-red-600']) }}>
        {{ $denied }}
    </div>
@endif
