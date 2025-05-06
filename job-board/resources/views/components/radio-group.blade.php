<div>
    <label for="{{ $name }}" class="mb-1 flex items-center">
        <input type="radio" name="{{ $name }}" id="experience" value="" class="mr-2" @checked(!request($name))><span>All</span>
    </label>
    @foreach($options as $option)
        <label for="experience" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" id="{{ $name }}" value="{{ $option }}" class="mr-2" @checked(request($name) === $option)><span>{{ $option }}</span>
        </label>
    @endforeach
</div>
