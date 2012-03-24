<?php
class JBuilderPackage extends JBuilderExtension
{
	static function getOptions()
	{
		return parent::getOptions();
	}
	
	public function check()
	{
		$requiredOptions = array('extensions');
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
		$this->out('TRYING TO BUILD '.$this->options['name'].' PACKAGE...');
		$this->out(str_repeat('-', 79));
		
		$this->prepareLanguageFiles(array('admin'));
		
		$this->addIndexFiles();
		
		$manifest = new JBuilderHelperManifest();
		
		$manifest = $this->setManifestData($manifest);
		
		//Here the missing options have to be set

		//Here we should save the manifest file to the disk
		JFile::write($this->buildfolder.'manifest.xml', $manifest->main());
		
		$this->createPackage();
		
		$this->out(str_repeat('-', 79));
		$this->out('PACKAGE '.$this->options['name'].' HAS BEEN SUCCESSFULLY BUILD!');
		$this->out(str_repeat('-', 79));
	}
}