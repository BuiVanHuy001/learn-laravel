<div class="relative">
    @if($type !== 'textarea')
        @if($formRef)
            <button type="button" @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit();" class="absolute inset-y-0 right-0 flex items-center pr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
        <input x-ref="input-{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ old($name) ?? $value }}" name="{{ $name }}" id="{{ $name }}" @class(['w-full rounded-md border-0 py-1.5 px-2.5 ring-1 placeholder:text-slate-400 focus:ring-2', 'pr-6' => $formRef, 'ring-slate-300' => !$errors->has($name), 'ring-red-500' => $errors->has($name)])/>
    @else
        <textarea x-ref="input-{{ $name }}" placeholder="{{ $placeholder }}" name="{{ $name }}" id="{{ $name }}"
            @class([
        'w-full rounded-md border-0 py-1.5 px-2.5 ring-1 placeholder:text-slate-400 focus:ring-2',
        'pr-6' => $formRef,
        'ring-slate-300' => !$errors->has($name),
        'ring-red-500' => $errors->has($name),
        ])
        >{{ old($name) ?? $value }}</textarea>
    @endif
    @error($name)
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>
