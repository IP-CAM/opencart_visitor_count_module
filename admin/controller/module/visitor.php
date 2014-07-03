<?php
class ControllerModuleVisitor extends Controller{
	public function index()
	{
		$this->language->load('module/visitor');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) 
		{
			$this->model_setting_setting->editSetting('visitor', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->template = 'module/visitor.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function install()
	{
		$this->load->model('setting/setting');

		$this->model_setting_setting->editSetting('visitor', 
			array(
				'visitor_module' => array(
					array(
						'layout_id' => '1',
						'position' => 'content_bottom',
						'status' => '1',
						'sort_order' => '-1'
					)
				)
			)	
		);

		$this->model_setting_setting->editSetting('visitor_count', array(
			'count' => '0'
		));
	}
} 
?>