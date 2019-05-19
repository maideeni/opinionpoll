<?php
class ControllerErrorNotFound extends Controller {
	public function index() {

		$data['base'] = HTTP_SERVER;

		$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

		$data['continue'] = $this->url->link('opinionpoll/opinion');

		
		$this->response->setOutput($this->load->view('template/error/not_found.tpl', $data));
		
	}
}