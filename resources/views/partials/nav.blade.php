<nav class="flex flex-wrap items-center gap-1 text-sm font-semibold">
    <a href="{{ route('home') }}"
       @class([
           'rounded-lg px-3 py-2 transition',
           'bg-slate-800 text-white' => request()->routeIs('home'),
           'text-slate-300 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('home'),
       ])>Home</a>

    <a href="{{ route('eateries.index') }}"
       @class([
           'rounded-lg px-3 py-2 transition',
           'bg-slate-800 text-white' => request()->routeIs('eateries.index', 'eateries.show', 'eateries.edit'),
           'text-slate-300 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('eateries.index', 'eateries.show', 'eateries.edit'),
       ])>Eateries</a>

    <a href="{{ route('districts.index') }}"
       @class([
           'rounded-lg px-3 py-2 transition',
           'bg-slate-800 text-white' => request()->routeIs('districts.*'),
           'text-slate-300 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('districts.*'),
       ])>Districts</a>

    <a href="{{ route('eateries.create') }}"
       class="ml-2 rounded-lg bg-teal-500 px-4 py-2 font-bold text-slate-900 transition hover:bg-teal-400">Add Eatery</a>
</nav>