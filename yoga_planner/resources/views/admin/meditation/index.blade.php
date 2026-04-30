<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10">

        <h2 class="text-2xl font-bold mb-4">Meditation Sessions</h2>

        <a href="{{ route('admin.meditation.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Add Meditation
        </a>

        @foreach($meditation as $m)
            <div class="bg-white p-4 mb-2 rounded shadow flex justify-between">
                <div>
                    <p class="font-bold">{{ $m->name }}</p>
                    <p>{{ $m->type }}</p>
                </div>

                <form method="POST" action="{{ route('admin.meditation.delete', $m->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                        Delete
                    </button>
                </form>
            </div>
        @endforeach

    </div>
</x-app-layout>