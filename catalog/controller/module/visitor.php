<?php  
class ControllerModuleVisitor extends Controller 
{
	protected function index($setting)
	{
		$this->data['greeting'] = 'Visitors World-Wide';

		$this->load->model('setting/setting');

		$r = $this->model_setting_setting->getSetting('visitor_count');

		$tmp = (int)$r['count'];
		$tmp = $tmp + 1;

		$this->model_setting_setting->editSetting('visitor_count', array(
			'count' => $tmp
		));

		$vis = (string)$tmp;
		$v = array(
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
		);

		$count = strlen($vis);

		$x = 0;
		for($i = ($count - 1); $i >= 0; $i--)
		{
			$v[$i] = $vis[$x];
			$x++;
		}

		$this->data['visitors'] = $v;

		$this->template = 'default/template/module/visitor.tpl';
		$this->render();
	}
}
?>	