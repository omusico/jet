<?php
class JBuilderLanguage extends JBuilderExtension
{
	static function getOptions()
	{
		return array_merge(parent::getOptions(), array('client', 'tag'));
	}
	
	public function check()
	{
		$requiredOptions = array('tag', 'client');
		$missing = array_diff($requiredOptions, array_keys($this->options));
		if(count($missing) > 0) {
			$this->out('['.$this->name.'] ERROR: The following basic options are missing: '.implode(', ', $missing));
			throw new Exception('*FATAL ERROR* Missing options!');
		}
		
		return parent::check();
	}

	public function build()
	{
		$this->out(str_repeat('-', 79));
		$this->out('TRYING TO BUILD '.$this->options['name'].' LANGUAGE...');
		$this->out(str_repeat('-', 79));
		
		$this->prepareMediaFiles();
		
		$this->addIndexFiles();
		
		$manifest = new JBuilderHelperManifest();
		
		$manifest = $this->setManifestData($manifest);
		
		//Here the missing options have to be set
		$manifest->setClient('both'); //Setting this to 'both' temporarily for testing purposes
		
		//Here we should save the manifest file to the disk
		//$this->out($manifest->main());
		
		$this->createPackage();
		
		$this->out(str_repeat('-', 79));
		$this->out('LANGUAGE '.$this->options['name'].' HAS BEEN SUCCESSFULLY BUILD!');
		$this->out(str_repeat('-', 79));
	}
}