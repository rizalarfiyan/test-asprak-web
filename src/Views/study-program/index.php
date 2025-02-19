<div class="flex flex-col gap-8">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-semibold text-center">Study Program:</h1>
    </div>
    <div hx-get="/study-program/table" hx-trigger="load, doReloadStudentTable from:body">Loading...</div>
</div>
