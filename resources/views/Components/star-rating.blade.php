@if($rating)
    @for ($i = 1; $i <= 5; $i++)
        {{-- {{ $i <= round($rating) ? <i class="fa-solid fa-star"></i> : '☆' }} --}}
        @if ($i <= round($rating))
            <i class="fa-solid fa-star text-yellow-500"></i>
        @else
            <i class="fa-regular fa-star"></i>
        @endif
    @endfor
@else 
    No rating yet
@endif