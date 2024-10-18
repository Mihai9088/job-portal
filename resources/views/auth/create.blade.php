<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Sign in</h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf

            <div class="mb-8">
                <label for="email" class="mb-2 block text-sm font-medium text-slate-900">Email</label>
                <x-text-input name="email" />
            </div>

            <div class="mb-8">
                <label class="mb-2 block text-sm font-medium text-slate-900"for="password">Password</label>
                <x-text-input name="password" type="password" />
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded-sm border border-slate-400">
                        <label for="">Remember me</label>
                    </div>
                </div>
                <a href="#" class="text-indigo-600 hover:underline">forget password?</a>
            </div>

            <x-button class="w-full bg-green-50 ">
                Login
            </x-button>
        </form>
    </x-card>
</x-layout>
