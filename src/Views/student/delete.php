<div _="on closeModal add .closing wait for animationend then remove me" class="modal">
    <div class="overlay" _="on click trigger closeModal"></div>
    <div class="content">
        <button class="close" _="on click trigger closeModal" aria-hidden="true" onclick="htmx.trigger('htmx:abort')">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="m15 9-6 6"/>
                <path d="m9 9 6 6"/>
            </svg>
        </button>
        <form hx-delete="/student/<?= $id ?>" class="mx-auto text-center py-5" hx-trigger="submit" hx-on::after-request="htmx.trigger(htmx.find('body'), 'doReloadStudentTable')">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="size-20 mx-auto mb-4 stroke-danger-500" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                <path d="M12 17h.01"/>
            </svg>
            <h2 class="text-2xl font-semibold">Are you sure?</h2>
            <p class="text-secondary-500">The action cannot be rollback!</p>
            <div class="flex gap-4 mt-5 items-center justify-center">
                <input name="nim" value="<?= $_GET['nim'] ?>" type="hidden">
                <button type="button" _="on click trigger closeModal" onclick="htmx.trigger('htmx:abort')" class="cursor-pointer px-4 py-2 text-slate bg-transparent rounded-md hover:bg-secondary-200 transition-colors duration-300">
                    Cancel
                </button>
                <button type="submit" class="cursor-pointer px-4 py-2 text-white bg-danger-500 rounded-md hover:bg-danger-600 transition-colors duration-300">
                    Sure
                </button>
            </div>
        </form>
    </div>
</div>
