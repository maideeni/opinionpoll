<?php
class ControllerOpinionpollOpinion extends Controller {
	private $error = array();

	public function index() {

		$data['base'] = HTTP_SERVER;

		$this->load->model('opinionpoll/opinion');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_opinionpoll_opinion->addVote($this->request->post);

			$this->response->redirect($this->url->link('opinionpoll/opinion/success', '', 'SSL'));

		}

		if (isset($this->error)) {
			$data['error'] = $this->error;
		} else {
			$data['error'] = array();
		}

		if (isset($this->request->post['vote'])) {
			$data['vote'] = $this->request->post['vote'];
		} else {
			$data['vote'] = array();
		}



		$data['action'] = $this->url->link('opinionpoll/opinion');

		$data['result'] = $this->url->link('opinionpoll/results');

		$data['questions'] = array();

		$question_info = $this->model_opinionpoll_opinion->getQuestions(); 
		if ($question_info) {

			foreach($question_info as $question)

			$data['questions'][] = array(
				'question_id'        => $question['question_id'],
				'title'              => $question['title'],
				'answers'            => $this->model_opinionpoll_opinion->getAnswers($question['question_id']),
				'status'             => $question['status']
			);
		}

		$this->response->setOutput($this->load->view('template/opinionpoll/opinion.tpl', $data));
	}

	public function success(){

		$data['base'] = HTTP_SERVER;

		$data['back'] = $this->url->link('opinionpoll/opinion');

		$this->response->setOutput($this->load->view('template/opinionpoll/success.tpl', $data));
	}

	private function validate(){

		$question_info = $this->model_opinionpoll_opinion->getQuestions(); 

		//echo '<pre>'.print_r($question_info, true).'</pre>';
		//echo '<pre>'.print_r($this->request->post, true).'</pre>';

		foreach($question_info as $question){

			if(!isset($this->request->post['vote'][$question['question_id']])){
				$this->error[$question['question_id']] = 'Please choose any one of these options';
			}


		}

		return !$this->error;
	}

}
?>