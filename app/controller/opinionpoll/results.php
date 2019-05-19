<?php
class ControllerOpinionpollResults extends Controller {
	private $error = array();

	public function index() {

		$data['base'] = HTTP_SERVER;

		$data['back'] = $this->url->link('opinionpoll/opinion');

		$this->load->model('opinionpoll/opinion');


		$data['results'] = array();

		$question_info = $this->model_opinionpoll_opinion->getQuestions(); 
		if ($question_info) {

			foreach($question_info as $question)

			$data['results'][] = array(
				'question_id'        => $question['question_id'],
				'title'              => $question['title'],
				'answers'            => $this->model_opinionpoll_opinion->getAnswers($question['question_id']),
				'status'             => $question['status']
			);
		}

		if($data['results']) {

			$idx = 0;

			$total_vote = 0;
			
			$vote_count = 0;
			
			foreach ($data['results'] as $question) {

				$total_vote = $this->model_opinionpoll_opinion->getTotalVote($question['question_id']); 

				$data['results'][$idx]['total_vote'] = $total_vote;

				$inc = 0;

				foreach ($question['answers'] as $answer) {			

					$vote_count = $this->model_opinionpoll_opinion->getVote($question['question_id'], $answer['answer_id']); 

					$data['results'][$idx]['answers'][$inc]['vote_count'] = $vote_count;

					$inc++;
				}

				$idx++;

			}
		}

		$this->response->setOutput($this->load->view('template/opinionpoll/results.tpl', $data));
	}

}
?>