<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10">

        <h2 class="text-3xl font-bold mb-6">Your Personalized Plan</h2>

        <div class="bg-yellow-100 p-4 rounded mb-6">
            🔥 Current Streak: <strong>{{ $streak }}</strong> days
        </div>

        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-xl font-semibold mb-2">Your Goal: {{ $preference->goal }}</h3>
            <p>Experience Level: {{ $preference->experience_level }}</p>
            <p>Available Time: {{ $preference->available_time }} minutes</p>
        </div>

        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-xl font-bold mb-4">Yoga Plan</h3>

            @forelse($yoga as $y)
                <div class="border-b py-2">
                    <p class="font-semibold">{{ $y->name }}</p>
                    <p>{{ $y->duration }} mins</p>
                </div>
            @empty
                <p>No yoga found for your preference</p>
            @endforelse
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-4">Meditation Plan</h3>

            @forelse($meditation as $m)
                <div class="border-b py-2">
                    <p class="font-semibold">{{ $m->name }}</p>
                    <p>{{ $m->duration }} mins</p>
                </div>
            @empty
                <p>No meditation found</p>
            @endforelse
        </div>
        <form method="POST" action="{{ route('complete') }}" class="mt-6">
            @csrf
            <button class="bg-purple-500 text-white px-6 py-2 rounded">
                Mark as Completed
            </button>
        </form>

        @if(session('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

    </div>
</x-app-layout>