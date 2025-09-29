<td class="px-2 py-2">
    <a role="button" {{ $attributes->merge([
        'class' => 'inline-flex items-center px-2 py-1 
                    bg-gray-800 border border-transparent rounded-md font-semibold text-xs 
                    text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
                    focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition 
                    ease-in-out duration-150'
    ]) }}>
        {{ $slot }}
    </a>
</td>
