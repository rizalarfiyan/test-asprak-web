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

	public function masterData()
	{
		try {
			$studyPrograms = $this->model('StudyPrograms')->getAll();
		} catch (\Exception) {
			$studyPrograms = [];
		}

		return [
			'studyPrograms' => $studyPrograms,
			'genders' => [
				[
					'name' => 'Laki-Laki',
					'value' => 'L',
				],
				[
					'name' => 'Perempuan',
					'value' => 'P',
				],
			],
			'hobbies' => [
				[
					'name' => 'Coding',
					'value' => 'coding',
				],
				[
					'name' => 'Reading',
					'value' => 'reading',
				],
				[
					'name' => 'Sport',
					'value' => 'sports',
				],
				[
					'name' => 'Music',
					'value' => 'music',
				],
				[
					'name' => 'Photography',
					'value' => 'photography',
				]
			],
		];
	}

	public function htmxCreate()
	{
		$data = $this->masterData();
		$this->renderHTMX('student/create', $data);
	}

	public function create()
	{
		$studentData = [
			'nim' => intval($_POST['nim']) ?? 0,
			'name' => $_POST['name'],
			'gender' => $_POST['gender'],
			'location_of_birth' => $_POST['location-of-birth'],
			'date_of_birth' => $_POST['date-of-birth'],
			'address' => $_POST['address'],
			'study_program_id' => $_POST['study-program'],
			'hobby' => implode(", ", $_POST['hobby'] ?? []),
		];

		try {
			$this->model('Students')->create($studentData);
			$this->successMessage('Student has been created.');
		} catch(\Exception $e) {
			$this->errorMessage('Failed to create student.');
		} finally {
			$this->closeModal();
		}
	}

	public function htmxDelete($id)
	{
		$this->renderHTMX('student/delete', [
			'id' => $id,
		]);
	}

	public function delete($id)
	{
		try {
			$this->model('Students')->delete($id);
			$this->successMessage('Student has been deleted.');
		} catch(\Exception $e) {
			$this->errorMessage('Failed to delete student.');
		} finally {
			$this->closeModal();
		}
	}
}
