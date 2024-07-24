@props(['name'])

@error($name)
    <p class="font-bold text-sm text-rose-800" >
        {{ $message }}
    </p>
@enderror
