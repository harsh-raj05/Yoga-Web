<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10">
        
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Welcome to Yoga & Meditation Planner 🧘‍♂️
        </h1>

        <div class="bg-white p-8 rounded-xl shadow-md">

            <p class="mb-6 text-gray-600">
                Create your personalized daily yoga and meditation routine based on your goals.
            </p>

            <div class="grid md:grid-cols-2 gap-6">

                <a href="/preferences"
                class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow hover:scale-105 transition">
                    <h2 class="text-xl font-bold">⚙ Set Preferences</h2>
                    <p class="opacity-90">Customize your plan</p>
                </a>

                <a href="/plan"
                class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-xl shadow hover:scale-105 transition">
                    <h2 class="text-xl font-bold">📋 View Plan</h2>
                    <p class="opacity-90">Check your routine</p>
                </a>

            </div>

        </div>

    </div>
</x-app-layout>