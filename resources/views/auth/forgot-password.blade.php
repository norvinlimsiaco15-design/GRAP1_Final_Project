<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
            <h1 class="text-2xl font-bold text-white" style="font-family: Montserrat, sans-serif;">Reset Password</h1>
            <div class="mb-4 mt-2 text-sm text-neutral-300">
                {{ __('Forgot your password? No problem. Enter your email and we will send a reset link.') }}
            </div>

            <x-auth-session-status class="mb-4 text-sm text-[#00FFAA]" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-neutral-200">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-xl border border-[#333] bg-[#171717] px-3 py-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="you@example.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <button type="submit" class="rounded-xl bg-[#FFD700] px-4 py-3 text-xs font-semibold uppercase tracking-wide text-[#0F0F0F] transition duration-200 hover:scale-[1.01] hover:bg-[#e7c300] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/50">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
