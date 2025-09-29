<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Liste des puzzles')
        </h2>
    </x-slot>
    
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow pt-6">
                    <table>
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-2 text-xs text-gray-500">#</th>
                                <th class="px-2 py-2 text-xs text-gray-500">Nom</th>
                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                                <th class="px-2 py-2 text-xs text-gray-500"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($puzzles as $puzzle)
                                <tr class="whitespace-nowrap">
                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $puzzle->id }}</td>
                                    <td class="px-4 py-4">{{ $puzzle->nom }}</td>
                                    <x-link-button href="{{ route('puzzles.edit', $puzzle->id) }}">
                                        @lang('Edit')
                                    </x-link-button>
                                    <x-link-button href="{{ route('puzzles.destroy', $puzzle->id) }}">
                                        @lang('Show')
                                    </x-link-button>
                                    <x-link-button onclick="event.preventDefault(); 
                                    document.getElementById('destroy{{ $puzzle->id }}').submit();">
                                        @lang('Delete')
                                    </x-link-button>
                                    <form id="destroy{{ $puzzle->id }}" action="{{ route('puzzles.show', $puzzle->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
