<?php

namespace App\Controllers;

use App\Core\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $this->render('student/index', [
			'title' => 'Student',
			'mainClass' => 'pt-4',
		]);
    }

	public function table()
	{
		$students = $this->model('Students')->getAll();
		$this->renderHTMX('student/table', [
			'students' => $students,
		]);
	}
}
