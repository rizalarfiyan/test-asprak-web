<?php

namespace App\Controllers;

use App\Core\Controller;

class StudyProgramController extends Controller
{
    public function index()
    {
        $this->render('study-program/index', [
			'title' => 'Study Program',
			'mainClass' => 'pt-4',
		]);
    }

	public function table()
	{
		$studyPrograms = $this->model('StudyPrograms')->getAllWithCount();
		$this->renderHTMX('study-program/table', [
			'studyPrograms' => $studyPrograms,
		]);
	}
}
