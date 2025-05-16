<div>
    @if($allOption)
        <label for="{{ $name }}" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" id="experience" value="" class="mr-2" @checked(!request($name))><span>All</span>
        </label>
    @endif
    @foreach($options as $option)
        <label for="experience" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" id="{{ $name }}" value="{{ $option }}" class="mr-2" @checked((request($name) ?? $value) === $option)><span>{{ ucfirst($option) }}</span>
        </label>
    @endforeach

    @error($name)
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
