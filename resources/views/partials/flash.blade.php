@if (session('success'))
    <div class="mb-8 flex items-start gap-3 rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 font-medium text-teal-900">
        <span aria-hidden="true" class="font-bold">✓</span>
        <p>{{ session('success') }}</p>
    </div>
@endif