<div _="on closeModal add .closing wait for animationend then remove me" class="modal">
    <div class="overlay" _="on click trigger closeModal"></div>
    <div class="content">
        <button class="close" _="on click trigger closeModal" aria-hidden="true" onclick="htmx.trigger('htmx:abort')">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="m15 9-6 6"/>
                <path d="m9 9 6 6"/>
            </svg>
        </button>
		<h2 class="text-xl font-semibold pb-4 border-b border-secondary-200 mb-4">
			Create Student
		</h2>
        <form class="mx-auto space-y-4" hx-put="/student/<?= $id ?>" hx-on::after-request="htmx.trigger(htmx.find('body'), 'doReloadStudentTable')">
            <div class="flex items-center justify-between gap-4">
                <div class="w-full space-y-2">
                    <label for="nim">NIM</label>
                    <input type="number" id="nim" name="nim" placeholder="22115227" value="<?= $student['nim'] ?>" readonly disabled required/>
                </div>
                <div class="w-full space-y-2">
                    <span class="label">Gender</span>
                    <div class="flex gap-4">
                        <?php foreach ($genders as $gender): ?>
                            <?php $id = strtolower("gender-{$gender['value']}") ?>
                            <div class="flex items-center mb-4">
                                <input id="<?= $id ?>" type="radio" name="gender" value="<?= $gender['value'] ?>" class="size-4" <?= $student['gender'] === $gender['value'] ? 'checked' : '' ?>>
                                <label for="<?= $id ?>" class="ms-2"><?= $gender['name'] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Muhamad Rizal Arfiyan" value="<?= $student['name'] ?>" required/>
            </div>
            <div class="flex items-center justify-between gap-4">
                <div class="w-full space-y-2">
                    <label for="location-of-birth">Location of Birth</label>
                    <input type="text" id="location-of-birth" name="location-of-birth" placeholder="Cimahi" value="<?= $student['location_of_birth'] ?>" required/>
                </div>
                <div class="w-full space-y-2">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" id="date-of-birth" name="date-of-birth" value="<?= $student['date_of_birth'] ?>" required/>
                </div>
            </div>
            <div class="space-y-2">
                <label for="message">Address</label>
                <textarea id="message" rows="4" name="address" placeholder="Your address here..." ><?= $student['address'] ?></textarea>
            </div>
            <div class="space-y-2">
                <label for="study-program">Study Program</label>
                <select id="study-program" name="study-program">
                    <option selected disabled>Select Program Study</option>
                    <?php foreach ($studyPrograms as $program): ?>
                        <option selected="<?= $student['study_program_id'] === $program['id'] ? 'true' : 'false' ?>" value="<?= $program['id'] ?>"><?= $program['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="space-y-2">
                <span class="label">Hobby</span>
                <div class="flex">
                    <?php foreach ($hobbies as $hobby): ?>
                        <?php $id = strtolower("hobby-{$hobby['value']}") ?>
                        <div class="flex items-center me-4">
                            <input id="<?= $id ?>>" type="checkbox" name="hobby[]" value="<?= $hobby['value'] ?>" <?= in_array($hobby['value'], $studentHobbies) ? 'checked' : '' ?> class="w-4 h-4 rounded">
                            <label for="<?= $id ?>>" class="ms-2 text-sm font-medium text-secondary-900"><?= $hobby['name'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="px-4 py-2 cursor-pointer mt-4 text-white bg-primary-500 rounded-md hover:bg-primary-600 transition-colors duration-300">
                Submit
            </button>
        </form>
    </div>
</div>
