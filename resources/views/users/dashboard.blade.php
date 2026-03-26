<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite('resources/css/app.css')
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

            <div class="mb-6 flex justify-center">
                @php
                $user = Auth::guard('user')->user();
                @endphp

                @if($user->image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $user->image->path) }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg transition-transform duration-300 group-hover:scale-105"
                        alt="Profile">
                    <a href="{{ route('Add-Image') }}" class="absolute bottom-0 right-0 bg-black text-white p-2 rounded-full shadow-md hover:bg-gray-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                </div>
                @else
                <a href="{{ route('Add-Image') }}" class="w-32 h-32 flex flex-col items-center justify-center rounded-full bg-gray-200 border-2 border-dashed border-gray-400 text-gray-500 hover:bg-gray-300 transition-all duration-300">
                    <span class="text-xs font-semibold">Add Photo</span>
                </a>
                @endif
            </div>
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-black mb-3">User Dashboard</h1>
                <p class="text-gray-500 text-lg">
                    Welcome, <span class="font-semibold text-black">{{ $user->name }}</span>
                </p>
            </div>
            <div class="space-y-4">
                {{-- Main Action Button --}}
                <a href="{{ route('post.index') }}" class="group relative inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-black text-white text-base font-semibold rounded-lg shadow-lg hover:bg-gray-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <span>View My Posts</span>
                </a>
                <div class="pt-8 border-t border-gray-200 mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-white text-gray-600 text-sm font-bold uppercase rounded-md border border-gray-200 hover:bg-gray-50 hover:text-red-600 hover:border-red-200 transition-all duration-300 shadow-sm">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>