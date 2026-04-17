<x-guest-layout>
    <div class="min-h-screen p-4 lg:p-0">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">
            <section class="relative hidden lg:block">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1400&q=80" alt="Streetwear fashion" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-14 left-14">
                    <h1 class="text-5xl font-extrabold tracking-wide text-white" style="font-family: Montserrat, sans-serif;">NV CREATIVE</h1>
                    <p class="mt-2 text-lg text-neutral-200">Wear Your Vision</p>
                </div>
            </section>
            <section class="flex items-center justify-center">
                <div class="w-full max-w-md rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl backdrop-blur-xl sm:p-8 animate-[fadeIn_.45s_ease-in]">
                    <div class="mb-7">
                        <h2 class="text-3xl font-bold text-white" style="font-family: Montserrat, sans-serif;">Welcome Back</h2>
                        <p class="mt-1 text-sm text-neutral-400">Log in to continue to NV CREATIVE.</p>
                    </div>

                    <x-auth-session-status class="mb-4 text-sm text-[#00FFAA]" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-neutral-200">Email</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-neutral-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 7.5 12 13l9-5.5"/><rect x="3" y="5" width="18" height="14" rx="2"/></svg>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full rounded-xl border border-[#333] bg-[#171717] py-3 pl-10 pr-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="you@example.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-neutral-200">Password</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-neutral-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 1 1 8 0v3"/></svg>
                                </span>
                                <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full rounded-xl border border-[#333] bg-[#171717] py-3 pl-10 pr-3 text-[#EAEAEA] placeholder:text-neutral-500 transition duration-200 focus:border-[#00FFAA] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/35" placeholder="Enter your password">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-neutral-300">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded border-[#444] bg-[#1b1b1b] text-[#FFD700] focus:ring-[#00FFAA]">
                                Remember me
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-sm text-neutral-300 transition hover:text-white" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-[#FFD700] px-4 py-3 text-sm font-semibold uppercase tracking-wide text-[#0F0F0F] transition duration-200 hover:scale-[1.01] hover:bg-[#e7c300] focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/50">
                            Login
                        </button>

                        <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-semibold text-[#111111] transition duration-200 hover:scale-[1.01] hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-[#00FFAA]/50">
                            <svg class="h-5 w-5" viewBox="0 0 48 48" aria-hidden="true">
                                <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303C33.648 32.657 29.244 36 24 36c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                                <path fill="#FF3D00" d="M6.306 14.691 12.88 19.51C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                                <path fill="#4CAF50" d="M24 44c5.167 0 9.86-1.977 13.409-5.193l-6.19-5.238C29.144 35.091 26.678 36 24 36c-5.223 0-9.613-3.316-11.283-7.946l-6.523 5.025C9.505 39.556 16.227 44 24 44z"/>
                                <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.038 12.038 0 0 1-4.085 5.569l6.19 5.238C36.971 39.165 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                            </svg>
                            Continue with Google
                        </a>
                    </form>

                    <p class="mt-6 text-center text-sm text-neutral-400">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-white transition hover:text-[#FFD700]">Register</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>
