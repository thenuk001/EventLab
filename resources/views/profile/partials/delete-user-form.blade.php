<section class="rounded-[2rem] border border-red-200 bg-red-50 p-6 shadow-sm">
    <header>
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-3xl">
            ⚠️
        </div>

        <p class="mt-5 text-sm font-black uppercase tracking-widest text-red-500">
            Danger Zone
        </p>

        <h2 class="mt-2 text-2xl font-black text-red-950">
            Delete Account
        </h2>

        <p class="mt-3 text-sm leading-7 text-red-700">
            Once your account is deleted, all related profile data will be permanently removed.
            This action is not recommended for admin accounts.
        </p>
    </header>

    <div class="mt-6 rounded-2xl border border-red-200 bg-white/70 p-4">
        <p class="text-sm font-bold text-red-700">
            Important:
        </p>

        <p class="mt-2 text-sm leading-6 text-red-600">
            Deleting an admin account may affect access to EventLab management features.
            Please continue only if you are sure.
        </p>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="mt-6 rounded-full bg-red-500 px-7 py-3 text-sm font-black text-white shadow-lg shadow-red-500/20 hover:bg-red-600"
    >
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-3xl">
                ⚠️
            </div>

            <h2 class="mt-5 text-2xl font-black text-red-950">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-3 text-sm leading-7 text-slate-600">
                This action is permanent. Please enter your password to confirm account deletion.
            </p>

            <div class="mt-6 rounded-2xl bg-red-50 p-4">
                <p class="text-sm font-bold text-red-700">
                    Warning: this cannot be undone.
                </p>
            </div>

            <div class="mt-6">
                <label for="password" class="sr-only">
                    Password
                </label>

                <input id="password"
                       name="password"
                       type="password"
                       placeholder="Enter your password"
                       class="w-full rounded-2xl border border-red-200 px-4 py-3 text-slate-950 shadow-sm focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200">

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="rounded-full bg-slate-100 px-6 py-3 text-sm font-black text-slate-700 hover:bg-slate-200">
                    Cancel
                </button>

                <button type="submit"
                        class="rounded-full bg-red-500 px-6 py-3 text-sm font-black text-white hover:bg-red-600">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>