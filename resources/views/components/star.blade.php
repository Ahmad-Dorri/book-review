@props(['starCount' => 0])

<div>
    @foreach(array_fill(0, $starCount, '٭') as $star)
        {{ $star }}
    @endforeach
</div>
