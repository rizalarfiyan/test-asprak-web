<?php

namespace App\Models;

use App\Core\Database;

class StudyPrograms {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

	public function getAll() {
		$this->db->query("SELECT id, name FROM study_programs");
		return $this->db->results();
	}
}
