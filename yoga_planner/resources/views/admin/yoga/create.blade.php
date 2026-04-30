<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Add Yoga</h2>

        <form method="POST" action="{{ route('admin.yoga.store') }}">
            @csrf

            <input type="text" name="name" placeholder="Name" class="w-full mb-3 p-2 border"><br>

            <select name="goal" class="w-full mb-3 p-2 border">
                <option value="weight_loss">Weight Loss</option>
                <option value="stress_relief">Stress Relief</option>
                <option value="flexibility">Flexibility</option>
            </select>

            <select name="level" class="w-full mb-3 p-2 border">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>

            <input type="number" name="duration" placeholder="Duration" class="w-full mb-3 p-2 border">

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>

    </div>
</x-app-layout>