<div class="relative overflow-x-auto mb-20">
    <table class="w-full text-sm text-left text-secondary-500">
        <thead class="text-xs uppercase text-secondary-700 bg-secondary-100">
        <tr>
            <th scope="col" class="px-6 py-3">
                #
            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Total
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($studyPrograms as $key => $program): ?>
            <tr class="bg-white <?= $key < count($studyPrograms) - 1 ? 'border-b border-secondary-200' : '' ?>">
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $program['id'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $program['name'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?= $program['total'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
