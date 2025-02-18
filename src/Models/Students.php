<?php

namespace App\Models;

use App\Core\Database;

class Students {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

	public function getAll()
	{
		$this->db->query("SELECT s.nim, s.name  AS name, gender, date_of_birth, location_of_birth, address, ps.name AS program_study, s.hobby FROM students s JOIN program_studies ps ON s.study_program_id = ps.id");
		return $this->db->results();
	}

	public function create($data)
	{
		$this->db->query("INSERT INTO students (nim, name, gender, date_of_birth, location_of_birth, address, study_program_id, hobby) VALUES (:nim, :name, :gender, :date_of_birth, :location_of_birth, :address, :study_program_id, :hobby)");
		$this->db->bind('nim', $data['nim']);
		$this->db->bind('name', $data['name']);
		$this->db->bind('gender', $data['gender']);
		$this->db->bind('date_of_birth', $data['date_of_birth']);
		$this->db->bind('location_of_birth', $data['location_of_birth']);
		$this->db->bind('address', $data['address']);
		$this->db->bind('study_program_id', $data['study_program_id']);
		$this->db->bind('hobby', $data['hobby']);
		$this->db->execute();
	}
}
