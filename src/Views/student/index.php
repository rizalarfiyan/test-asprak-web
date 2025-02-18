<div class="flex flex-col gap-8">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-semibold text-center">Students:</h1>
        <button hx-get="/student/create" hx-target="body" hx-swap="beforeend" class="ml-4 px-4 py-2 text-white cursor-pointer bg-primary-500 rounded-md hover:bg-primary-600 transition-colors duration-300">
            Create
        </button>
    </div>
    <div hx-get="/student/table" hx-trigger="load, doReloadStudentTable from:body">Loading...</div>
</div>
