<header class="bg-white border-b px-6 py-4">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Dashboard Admin
            </h1>

            <p class="text-sm text-slate-500">
                Kelola materi, evaluasi, dan pengguna.
            </p>

        </div>

        {{-- User --}}
        <div class="relative">

            <button
                onclick="toggleUserMenu()"
                class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                <span class="font-medium">
                    {{ auth()->user()->name }}
                </span>

                <i class="bi bi-chevron-down"></i>

            </button>

            <div
                id="userMenu"
                class="hidden absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg border z-50">

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left px-4 py-3 hover:bg-gray-100 rounded-xl">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>

<script>
function toggleUserMenu() {
    document
        .getElementById('userMenu')
        .classList
        .toggle('hidden');
}

document.addEventListener('click', function(e){

    let menu = document.getElementById('userMenu');

    if(!e.target.closest('.relative')){
        menu.classList.add('hidden');
    }

});
</script>