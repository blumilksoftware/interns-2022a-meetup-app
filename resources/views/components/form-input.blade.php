<div>
    <label for="{{ $id }}" class="block font-medium text-gray-700">
        {{ $name }}
    </label>
    <div class="mt-1">
        <input type="{{ $type }}" name="{{ $id }}" id="{{ $id }}"
            placeholder="{{ $name }}..." value="{{ $value }}"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            {{ $type === 'number' ? $attributes->merge(['min' => '0']) : '' }} />
        <x-input-error for="{{ $id }}" />
    </div>
</div>
