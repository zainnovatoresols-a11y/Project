<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 h-screen flex flex-col">

    <main class="flex-1 flex flex-col items-center justify-center p-8 relative overflow-hidden">

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gray-200 rounded-full opacity-20 blur-3xl -z-10"></div>
        <div class="text-center max-w-lg w-full">
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-black mb-3">Dashboard</h1>
                <p class="text-gray-500 text-lg">
                    Welcome back, <span class="font-semibold text-black decoration-gray-300">{{ Auth::guard('admin')->user()->name }}</span>
                </p>
            </div>
            <div class="space-y-4">
                <a href="{{ route('post.index') }}" class="group relative inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-black text-white text-base font-semibold rounded-lg shadow-lg hover:bg-gray-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <span>Manage Posts</span>
                </a>
                <p class="text-sm text-gray-400 mt-2">
                    Select "Manage Posts" to begin editing content.
                </p>
                <div class="pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-gray-200 text-gray-900 text-sm font-bold uppercase tracking-wide rounded-md border border-gray-300 hover:bg-gray-300 hover:border-gray-400 transition-all duration-300 shadow-sm">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </main>
</body>

</html>