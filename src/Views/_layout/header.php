<?php
	$appName = 'Asprak';
	$current = $_SERVER['REQUEST_URI'];
	$menus = [
		[
			'path' => '/',
			'name' => 'Home',
		],
		[
			'path' => '/student',
			'name' => 'Student',
		],
		[
			'path' => '/program-study',
			'name' => 'Program Study',
		]
	];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= isset($title) ? "{$title} - {$appName}" : $appName ?></title>
	<link rel="stylesheet" href="style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/htmx/2.0.4/htmx.min.js" integrity="sha512-2kIcAizYXhIn8TzUvqzEDZNuDZ+aW7yE/+f1HJHXFjQcGNfv1kqzJSTBRBSlOgp6B/KZsz1K0a3ZTqP9dnxioQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/hyperscript/0.9.10/_hyperscript.min.js" integrity="sha512-awQNhUqpAZSFStlqtXXQgh85OmajVgFCZ5rckAdD4Y7J/LZQo/QuMmkd6ElVNM2UsiUFbhTb9ultQNMj18ku7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="font-sans antialiased scroll-smooth bg-secondary-50 text-secondary-800 flex flex-col min-h-screen">
	<header class="fixed top-0 left-0 w-full border-b text-secondary-800 bg-white z-50 border-secondary-300">
		<div class="container flex justify-between items-center gap-4">
			<div class="text-2xl font-semibold">
				<?= $appName ?>
			</div>
			<ul class="flex gap-2 p-4">
				<?php foreach ($menus as $menu): ?>
					<li><a class="px-3 py-2 font-semibold transition-colors duration-300 text-secondary-600 hover:text-primary-600 <?= $menu['path'] == $current ? '!text-primary-600 underline underline-offset-2 decoration-2' : '' ?>" href="<?= $menu['path'] ?>"><?= $menu['name'] ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</header>
	<main class="mt-16 grow container <?= $mainClass ?? '' ?>">
