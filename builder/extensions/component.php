<?php
class JBuilderComponent extends JBuilderExtension
{
	static function getOptions()
	{
		return array_merge(parent::getOptions(), array('copyright', 'version', 'email', 'website', 'sql'));
	}
	
	public function check()
	{
		return true;
	}

	public function build()
	{
		$this->out(str_repeat('-', 79));
		$this->out('TRYING TO BUILD '.$this->options['name'].' COMPONENT...');
		$this->out(str_repeat('-', 79));
		
		/**
		 * 	<!--
	This build file can create a single Joomla component based on a properties file. 
	Alternatively it can be used in batch mode
	
	The following properties have to be defined for a component to build successfully:
	  - Component name (component.name) "com_content"
	  - Copyright Statement (component.copyright) "(C) 2005 - 2011 Open Source Matters. All rights reserved."
	  - Version (component.version) "2.5.0"
	  - Author (project.author) "Joomla! Project"
	  - Author E-Mail (project.email) "admin@joomla.org"
	  - Author Website (project.website) "http://www.joomla.org"
	  - Joomla Folder (project.joomla-folder) "/var/www"
	Optional properties: (If not given, the shown defaults will be used)
	  - Build Folder (project.build-folder) "/var/www/.build" (default: ${project.joomla-folder}/.build)  
	  - License (project.license) "GNU General Public License version 2 or later; see LICENSE.txt" (default: GNU General Public License version 2 or later; see LICENSE.txt)
	  - Updatesite (component.update) "http://example.com/collection.xml" (default: none)
	These properties can be set in a properties file or handed in via a batch build. See component.properties for an example.
	-->
	<!-- This target builds a Joomla component package-->
	<target name="component-build" depends="component-build-prepare">
	
		<!-- Processing backend component part -->
		<if>
			<available file="${project.joomla-folder}/administrator/components/${component.name}" type="dir" />
			<then>
				<echo msg="Found a backend component part!" />
				<property name="component.admin" value="true" />
				<echo msg="Creating folder for backend component part." /> 
				<mkdir dir="${project.build-folder}/components/${component.name}/admin" />
				<echo msg="Copy the files for backend component part." />
				<copy todir="${project.build-folder}/components/${component.name}/admin">
					<fileset dir="${project.joomla-folder}/administrator/components/${component.name}">
						<include name="**" />
						<exclude name="manifest.xml" />
					</fileset>
				</copy>
				<echo msg="----------------------------------------" />
			</then>
			<else>
				<property name="component.admin" value="false" />
			</else>
		</if>
		
		<!-- Processing frontend component part -->
		<if>
			<available file="${project.joomla-folder}/components/${component.name}" type="dir" />
			<then>
				<echo msg="Found a frontend component part!" />
				<property name="component.front" value="true" />
				<echo msg="Creating folder for frontend component part." /> 
				<mkdir dir="${project.build-folder}/components/${component.name}/front" />
				<echo msg="Copy the files for frontend component part." />
				<copy todir="${project.build-folder}/components/${component.name}/front">
					<fileset dir="${project.joomla-folder}/components/${component.name}">
						<include name="**" />
					</fileset>
				</copy>
				<echo msg="----------------------------------------" />
			</then>
			<else>
				<property name="component.front" value="false" />
			</else>
		</if>

		<!-- Processing media folder part -->
		<if>
			<available file="${project.joomla-folder}/media/${component.name}" type="dir" />
			<then>
				<echo msg="Found a media folder for this component!" />
				<property name="component.media" value="true" />
				<echo msg="Creating folder for media files." />
				<mkdir dir="${project.build-folder}/components/${component.name}/media" />
				<echo msg="Copy media files." />
				<copy todir="${project.build-folder}/components/${component.name}/media">
					<fileset dir="${project.joomla-folder}/media/${component.name}">
						<include name="**" />
					</fileset>
				</copy>
				<echo msg="----------------------------------------" />
			</then>
			<else>
				<property name="component.media" value="false" />
			</else>
		</if>

		<!-- Processing language file parts -->
		<if>
			<available file="${project.joomla-folder}/administrator/language/en-GB/en-GB.${component.name}.ini" type="file" />
			<then>
				<echo msg="Found a backend language file!" />
				<mkdir dir="${project.build-folder}/components/${component.name}/language/admin" />
				<copy todir="${project.build-folder}/components/${component.name}/language/admin">
					<fileset dir="${project.joomla-folder}/administrator/language">
						<include name="*\ *.${component.name}*.ini" />
					</fileset>
				</copy>
				<echo msg="----------------------------------------" />
			</then>
		</if>
		
		<if>
			<available file="${project.joomla-folder}/language/en-GB/en-GB.${component.name}.ini" type="file" />
			<then>
				<echo msg="Found a frontend language file!" />
				<mkdir dir="${project.build-folder}/components/${component.name}/language/front" />
				<copy todir="${project.build-folder}/components/${component.name}/language/front">
					<fileset dir="${project.joomla-folder}/language">
						<include name="*\*.${component.name}*.ini" />
					</fileset>
				</copy>		
				<echo msg="----------------------------------------" />
			</then>
		</if>		

		<!-- Adding index.html files where necessary -->
		<echo msg="Adding index.html files to folders" />
		<indexfiles path="${project.build-folder}/components/${component.name}/" />
		<echo msg="----------------------------------------" />
		
		<!-- Creating manifest file -->
		<echo msg="Creating manifest file" />
		<joomlamanifest 
			type="component" 
			extname="${component.name}" 
			buildfolder="${project.build-folder}/components/${component.name}" 
			version="${component.version}"
			copyright="${component.copyright}"
			author="${project.author}"
			email="${project.email}"
			website="${project.website}"
			license="${project.license}"
			update="${component.update}"
		/>
		<echo msg="Manifest file created!" />
		<echo msg="----------------------------------------" />
		
		<!-- Zipping up the component package -->
		<echo msg="Zipping up the component package" />

		<delete file="${project.build-folder}/${component.name}.zip" quiet="true" />
		<zip destfile="${project.build-folder}/${component.name}.zip">
			<fileset dir="${project.build-folder}/components/${component.name}" />
		</zip>
		<echo msg="ZIP file created!" />
	</target>
		 */
		$this->out(str_repeat('-', 79));
		$this->out('COMPONENT '.$this->options['name'].' HAS BEEN SUCCESSFULLY BUILD!');
		$this->out(str_repeat('-', 79));
	}
}