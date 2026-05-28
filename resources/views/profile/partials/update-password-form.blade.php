<section>
    <header>
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-sm font-black uppercase tracking-widest text-purple-500">
                    Account Security
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-950">
                    Update Password
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Use a strong password to keep your EventLab admin account secure.
                </p>
            </div>

            <div class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-3xl sm:flex">
                🔑
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="mb-2 block text-sm font-bold text-slate-700">
                Current Password
            </label>

            <input id="update_password_current_password"
                   name="current_password"
                   type="password"
                   autocomplete="current-password"
                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200">

            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="mb-2 block text-sm font-bold text-slate-700">
                New Password
            </label>

            <input id="update_password_password"
                   name="password"
                   type="password"
                   autocomplete="new-password"
                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200">

            @error('password', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">
                Confirm Password
            </label>

            <input id="update_password_password_confirmation"
                   name="password_confirmation"
                   type="password"
                   autocomplete="new-password"
                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200">

            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-2xl bg-slate-50 p-5">
            <p class="text-sm font-black text-slate-800">
                Password Recommendation
            </p>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Use at least 8 characters with uppercase letters, lowercase letters, numbers, and symbols.
            </p>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="rounded-full bg-slate-950 px-7 py-3 text-sm font-black text-white hover:bg-purple-600">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600"
                >
                    Password updated.
                </p>
            @endif
        </div>
    </form>
</section>