<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yoga Planner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-100 via-green-100 to-purple-100 min-h-screen">

    <div class="flex flex-col items-center justify-center min-h-screen px-4">

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur-lg p-10 rounded-2xl shadow-xl text-center max-w-lg w-full">

            <h1 class="text-4xl font-extrabold text-gray-800 mb-3">
                🧘 Yoga Planner
            </h1>

            <p class="text-gray-600 mb-8">
                Personalized yoga & meditation plans tailored just for you.
            </p>

            @auth
                <a href="/dashboard"
                   class="w-full inline-block bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition">
                    Go to Dashboard →
                </a>
            @else
                <div class="flex gap-4 justify-center">

                    <a href="/login"
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition text-center">
                        Login
                    </a>

                    <a href="/register"
                       class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition text-center">
                        Register
                    </a>

                </div>
            @endauth

        </div>

        <!-- Footer -->
        <p class="mt-6 text-sm text-gray-500">
            Stay healthy • Stay mindful • Stay consistent 🔥
        </p>

    </div>

</body>
</html>