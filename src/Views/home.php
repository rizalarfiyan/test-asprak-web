<div class="flex flex-col gap-8">
    <h1 class="text-3xl font-semibold text-center">Pages:</h1>
    <div class="flex items-center justify-center gap-8 text-secondary-600">
        <?php foreach ($urls as $url) : ?>
            <a href="<?= $url['url'] ?>" class="flex flex-col items-center gap-2 p-10 transition-colors duration-300 border-2 rounded-md min-w-60 border-secondary-200 hover:border-primary-500">
                <?= $url['icon'] ?>
                <h4 class="text-xl font-semibold"><?= $url['name'] ?></h4>
            </a>
        <?php endforeach; ?>
    </div>
</div>
