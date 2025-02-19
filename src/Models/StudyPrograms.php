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

	public function getAllWithCount() {
		$query = "WITH students AS (
			SELECT count(nim) as total, study_program_id as id FROM students GROUP BY study_program_id
		)
		SELECT sp.id, sp.name, coalesce(s.total, 0) as total
		FROM study_programs sp
		LEFT JOIN students s USING (id)";

		$this->db->query($query);
		return $this->db->results();
	}
}
