<section>
    <header>
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-sm font-black uppercase tracking-widest text-orange-500">
                    Personal Details
                </p>

                <h2 class="mt-2 text-2xl font-black text-slate-950">
                    Profile Information
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Update your account name and email address used for EventLab admin access.
                </p>
            </div>

            <div class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-3xl sm:flex">
                👤
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="mb-2 block text-sm font-bold text-slate-700">
                Name
            </label>

            <input id="name"
                   name="name"
                   type="text"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200">

            @error('name')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                Email
            </label>

            <input id="email"
                   name="email"
                   type="email"
                   value="{{ old('email', $user->email) }}"
                   required
                   autocomplete="username"
                   class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-950 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-200">

            @error('email')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-2xl bg-orange-50 p-4">
                    <p class="text-sm text-orange-700">
                        Your email address is unverified.

                        <button form="send-verification"
                                class="font-black underline hover:text-orange-900">
                            Click here to resend the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-bold text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="rounded-full bg-orange-500 px-7 py-3 text-sm font-black text-white hover:bg-orange-400">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600"
                >
                    Saved successfully.
                </p>
            @endif
        </div>
    </form>
</section>