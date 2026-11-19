<dialog id="confirm-dialog"
        class="m-auto w-[calc(100%-2rem)] max-w-md overflow-hidden rounded-2xl bg-white p-0 shadow-xl backdrop:bg-slate-900/60">
    <div class="p-6">
        <h2 id="confirm-title" class="text-xl font-extrabold text-slate-900">Are you sure?</h2>
        <p id="confirm-message" class="mt-2 text-slate-600"></p>
    </div>
    <div class="flex justify-end gap-3 bg-slate-50 px-6 py-4">
        <button type="button" id="confirm-cancel"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 hover:bg-slate-100">Cancel</button>
        <button type="button" id="confirm-ok"
                class="rounded-lg bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">Delete</button>
    </div>
</dialog>