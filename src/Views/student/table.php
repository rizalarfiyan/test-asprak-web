<div class="relative overflow-x-auto mb-20">
    <table class="w-full text-sm text-left text-secondary-500">
        <thead class="text-xs uppercase text-secondary-700 bg-secondary-100">
        <tr>
            <th scope="col" class="px-6 py-3">
                #
            </th>
            <th scope="col" class="px-6 py-3">
                NIM
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Gender
            </th>
            <th scope="col" class="px-6 py-3">
                Birth
            </th>
            <th scope="col" class="px-6 py-3">
                Address
            </th>
            <th scope="col" class="px-6 py-3">
                Program Study
            </th>
            <th scope="col" class="px-6 py-3">
                Hobby
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $key => $student): ?>
            <tr class="bg-white <?= $key < count($students) - 1 ? 'border-b border-secondary-200' : '' ?>">
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $key + 1 ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['nim'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['name'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded <?= $student['gender'] === 'L' ? 'bg-warning-100 text-warning-800' : 'bg-danger-100 text-danger-800' ?>">
                        <?= $student['gender'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['location_of_birth'] ?>
                    , <?= date_format(date_create($student['date_of_birth']), 'd M Y') ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['address'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['program_study'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $student['hobby'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex gap-2">
                        <button hx-get="/student/delete/<?= $student['nim'] ?>" hx-target="body" hx-swap="beforeend" class="px-2 py-1 cursor-pointer text-white text-sm bg-danger-500 rounded-md hover:bg-danger-600 transition-colors duration-300">
                            Delete
                        </button>
                        <button hx-get="/student/update/<?= $student['nim'] ?>" hx-target="body" hx-swap="beforeend" class="px-2 py-1 cursor-pointer text-white text-sm bg-success-500 rounded-md hover:bg-success-600 transition-colors duration-300">
                            Edit
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
