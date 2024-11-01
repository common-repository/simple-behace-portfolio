<?php
/**
* Plugin Name: Simple Behance Portfolio
* Plugin URI: http://jakubbilko.pl/
* Description: A simple plugin for displaying Behance portfolios
* Version: 0.2
* Author: Jakub Bilko
* Author URI: http://jakubbilko.pl/
* Licence: GPLv2
*/

require_once( 'titan-framework/titan-framework-embedder.php' );

class SimpleBehancePortfolio {
	
	private $titan;
	
	public function __construct() {
		
		add_action( 'tf_create_options', array($this, 'sbhpf_init_options'));
		add_action( 'wp_enqueue_scripts', array($this, 'sbhpf_init_styles'));
		
	}
	
	public function sbhpf_init_options() {
		
		$this->titan = TitanFramework::getInstance('sbhpf');
		
		$panel = $this->titan->createAdminPanel( array(
	        'name' => 'Simple Behance Portfolio',
	    ));
	    
	    $panel->createOption(array(
		    'name' => 'API Key',
		    'id' => 'api_key',
		    'type' => 'text',
		    'desc' => 'Behance API Key',
		    'default' => 'your_api_key'
	    ));
	    
	    $panel->createOption(array(
		    'name' => 'Username',
		    'id' => 'user',
		    'type' => 'text',
		    'desc' => 'Behance Username',
		    'default' => 'your_username'
	    ));
	    
	    $panel->createOption(array(
		    'name' => 'Projects',
		    'id' => 'count',
		    'type' => 'number',
		    'min' => 1,
		    'max' => 25,
		    'desc' => '# of projects to show (max 25)',
		    'default' => '25'
	    ));
	    
	    $panel->createOption(array(
		    'name' => 'Project titles',
		    'id' => 'titles',
		    'type' => 'checkbox',
		    'desc' => 'Show project titles on hover',
		    'default' => false
	    ));
	    
	    $panel->createOption( array(
		    'type' => 'note',
		    'desc' => 'To display the portfolio, use the following shortcore: <strong>[BehancePortfolio]</strong>'
		));
	    
	    $panel->createOption( array(
        	'type' => 'save'
		));
	}
	
	public function init_shortcode() {
		
		add_shortcode('BehancePortfolio', array($this, 'sbhpf_init_shortcode'));
		
	}
	
	public function sbhpf_init_shortcode() {
		
		$key = trim($this->titan->getOption('api_key'));
		$user = trim($this->titan->getOption('user'));
		$count = $this->titan->getOption('count');
		$titles = $this->titan->getOption('titles');
		
		if($key === 'your_api_key' || $user === 'your_username') {
			return '<p>Please configure the Simple Behance Portfolio plugin!</p>';
		}
		
		$url = "https://www.behance.net/v2/users/$user/projects?api_key=$key&per_page=$count";
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$data = curl_exec($ch);
		$projects = json_decode($data, true);
		
		$output = "";
		$output .= "<div id='bhpf-portfolio'>";
		
		
		foreach($projects['projects'] as $project) {
			$thumb = '';
			$url = $project['url'];
			if(array_key_exists('404', $project['covers'])) {
				$thumb = $project['covers']['404'];
			} elseif(array_key_exists('230', $project['covers'])) {
				$thumb = $project['covers']['230'];
			} elseif(array_key_exists('202', $project['covers'])) {
				$thumb = $project['covers']['202'];
			} else {
				$thumb = $project['covers']['115'];
			}
			$output .= "<div class='bhpf-project'>";
			$output .= "<a href='$url' target='_new'>";
			$output .= "<img src='" . $thumb . "' alt='' />";
			$output .= ($titles ? '<span>' . $project['name'] . '</span>' : '');
			$output .= "</a>";
			$output .= "</div>";
		}
		
		$output .= "</div>";
		
		return $output;
		
	}
	
	public function sbhpf_init_styles() {
		wp_enqueue_style( 'bhpf-front', plugin_dir_url(__FILE__) . '/css/sbhpf-front.css');
	}
	
}

$sbhpf = new SimpleBehancePortfolio();
$sbhpf->init_shortcode();

?>