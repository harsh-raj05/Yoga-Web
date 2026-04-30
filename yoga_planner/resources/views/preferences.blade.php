<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">

        <h2 class="text-2xl font-bold mb-6">Your Preferences</h2>

        <form method="POST" action="{{ route('preferences.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Age</label>
                <input type="number" name="age" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block">Goal</label>
                <select name="goal" class="w-full border p-2 rounded" required>
                    <option value="weight_loss">Weight Loss</option>
                    <option value="stress_relief">Stress Relief</option>
                    <option value="flexibility">Flexibility</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Experience Level</label>
                <select name="experience_level" class="w-full border p-2 rounded" required>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Available Time (minutes)</label>
                <input type="number" name="available_time" class="w-full border p-2 rounded" required>
            </div>

            <!-- ✅ BUTTON -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Save Preferences
                </button>
            </div>

        </form>
    </div>
</x-app-layout>