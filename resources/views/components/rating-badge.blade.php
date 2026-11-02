@props([
    'score' => 9.4,
    'label' => 'Editor\'s Choice',
    'size' => 'md',
    'variant' => 'amber',
])

@php
    $numericScore = is_numeric($score) ? number_format((float) $score, 1) : $score;

    $variantClasses = match ($variant) {
        'emerald' => 'bg-emerald-600 text-white border-emerald-500 badge-pulse-emerald',
        'dark' => 'bg-slate-900 text-white border-slate-700',
        default => 'bg-amber-500 text-slate-950 border-amber-400 badge-pulse-amber',
    };

    $sizeClasses = match ($size) {
        'sm' => 'px-2 py-0.5 text-[11px] gap-1 rounded-lg',
        'lg' => 'px-3.5 py-1.5 text-sm gap-2 rounded-xl',
        default => 'px-2.5 py-1 text-xs gap-1.5 rounded-xl',
    };
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-center font-bold border shadow-xs select-none {$variantClasses} {$sizeClasses}"]) }}>
    <span class="font-mono font-extrabold tracking-tight">{{ $numericScore }}<span class="opacity-70 text-[10px] font-semibold">/10</span></span>
    @if($label)
        <span class="w-px h-3 bg-current opacity-25"></span>
        <span class="uppercase tracking-wider text-[10px] font-extrabold">{{ $label }}</span>
    @endif
</div>
