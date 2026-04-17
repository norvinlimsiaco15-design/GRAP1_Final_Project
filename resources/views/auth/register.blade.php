<x-guest-layout>
    <div class="min-h-screen p-4 lg:p-0">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">
            <section class="relative hidden lg:block">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1400&q=80" alt="Premium streetwear display" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-14 left-14">
                    <h1 class="text-5xl font-extrabold tracking-wide text-white" style="font-family: Montserrat, sans-serif;">NV CREATIVE</h1>
                    <p class="mt-2 text-lg text-neutral-200">Wear Your Vision</p>
                </div>
            </section>
            <section class="flex items-center justify-center">
                <div class="w-full max-w-md rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-xl sm:p-8 animate-[fadeIn_.45s_ease-in]">
                    <div class="mb-7">
                        <h2 class="text-3xl font-bold text-white" style="font-family: Montserrat, sans-serif;">Create Account</h2>
                        <p class="mt-1 text-sm text-neutral-400">Join NV CREATIVE and start shopping your vision.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-neutral-200">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full rounded-xl border border-[#333] bg-[#171717] px-3 py-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="Your full name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-neutral-200">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full rounded-xl border border-[#333] bg-[#171717] px-3 py-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="you@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-neutral-200">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full rounded-xl border border-[#333] bg-[#171717] px-3 py-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="Create a password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-neutral-200">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full rounded-xl border border-[#333] bg-[#171717] px-3 py-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="Confirm password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-[#FFD700] px-4 py-3 text-sm font-semibold uppercase tracking-wide text-[#0F0F0F] transition duration-200 hover:scale-[1.01] hover:bg-[#e7c300] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/50">
                            Register
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-neutral-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-semibold text-white transition hover:text-[#FFD700]">Login</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>
