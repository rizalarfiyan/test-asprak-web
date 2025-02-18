<?php

namespace App\Models;

use App\Core\Database;

class Students {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

	public function getAll() {
		$this->db->query("SELECT s.nim, s.name  AS name, gender, date_of_birth, location_of_birth, address, ps.name AS program_study, s.hobby FROM students s JOIN program_studies ps ON s.study_program_id = ps.id");
		return $this->db->results();
	}
}
