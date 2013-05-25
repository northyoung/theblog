<?php
	class MyTpl extends Smarty{
		function __construct(){
			$this->template_dir = TEMPLATE_PATH;
			$this->complie_dir = TEMPLATE_COMPILE_PATH;
			$this->cache_dir = TEMPLATE_CACHE_PATH;
			$this->caching = TEMPLATE_CACHE_START;
			$this->cache_lifetime = TEMPLATE_CACHE_LIFETIME;
			$this->left_delimiter = '<{';
			$this->right_delimiter = '}>';
		}
	}	
