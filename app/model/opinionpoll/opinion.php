<?php
class ModelOpinionpollOpinion extends Model {

	public function addVote($data) {

		foreach($data['vote'] as $questoin_id=>$answer_id){
			$result_exit = $this->db->query("SELECT * FROM " . DB_PREFIX . "results r WHERE question_id = '".(int)$questoin_id."' AND answer_id = '".(int)$answer_id."'")->num_rows;

			if($result_exit == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "results SET question_id = '".(int)$questoin_id."', answer_id = '".(int)$answer_id."', vote = 1");
			} else {
				$this->db->query("UPDATE " . DB_PREFIX . "results SET vote = vote + 1 WHERE question_id = '".(int)$questoin_id."' AND answer_id = '".(int)$answer_id."'");
			}
		}
	}

	public function getQuestions() {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "question q WHERE q.status = '1' ORDER BY q.sort_order, LCASE(q.title)");

		return $query->rows;
	}

	public function getAnswers($question_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "answer a WHERE a.question_id = '".(int)$question_id."' ORDER BY a.sort_order, LCASE(a.title)");

		return $query->rows;
	}

	public function getTotalVote($question_id) {

		$query = $this->db->query("SELECT SUM(vote) as total_vote FROM " . DB_PREFIX . "results WHERE question_id = '".(int)$question_id."'");

		return $query->row['total_vote'];
	}

	public function getVote($question_id, $answer_id) {

		$query = $this->db->query("SELECT vote  FROM " . DB_PREFIX . "results WHERE question_id = '".(int)$question_id."' AND answer_id = '".(int)$answer_id."'");

		return $query->row['vote'];
	}


}

?>