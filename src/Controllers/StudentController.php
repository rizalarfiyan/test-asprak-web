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

	public function create($req)
	{
		$studentData = [
			'nim' => intval($req['nim']) ?? 0,
			'name' => $req['name'],
			'gender' => $req['gender'],
			'location_of_birth' => $req['location-of-birth'],
			'date_of_birth' => $req['date-of-birth'],
			'address' => $req['address'],
			'study_program_id' => $req['study-program'],
			'hobby' => implode(", ", $req['hobby'] ?? []),
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

	public function htmxUpdate($id)
	{
		$student = $this->model('Students')->getById($id);
		if (!$student) {
			$this->errorMessage('Student not found.');
			$this->closeModal();
			return;
		}

		$data = $this->masterData();
		$data['id'] = $id;
		$data['student'] = $student;
		$data['studentHobbies'] = explode(", ", $student['hobby']);
		$this->renderHTMX('student/update', $data);
	}

	public function update($id, $req)
	{
		$hasFound = $this->model('Students')->hasId($id);
		if (!$hasFound) {
			$this->errorMessage('Student not found.');
			$this->closeModal();
			return;
		}

		$studentData = [
			'name' => $req['name'],
			'gender' => $req['gender'],
			'location_of_birth' => $req['location-of-birth'],
			'date_of_birth' => $req['date-of-birth'],
			'address' => $req['address'],
			'study_program_id' => $req['study-program'],
			'hobby' => implode(", ", $req['hobby'] ?? []),
		];

		try {
			$this->model('Students')->update($id, $studentData);
			$this->successMessage('Student has been updated.');
		} catch(\Exception $e) {
			$this->errorMessage('Failed to update student.');
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
