<?php
if(!defined('_lib')) die("Error");
$pagination = new pagination(array("current" => $_REQUEST['p']));
class pagination{
	var $current = 1;
	var $count = 0;
	var $count_item = 0;
	var $max_page = 5;
	var $max_item = 10;
	var $left;
	var $right;
	var $control_left;
	var $control_right;
	var $items;
	var $source;

	function pagination($config = array()) {
		if(!empty($config)) {
			foreach ($config as $key => $value)
				if(@$value!="")
					$this->$key = $value;
		}
	}

	function paging($itemList, $max_it = false, $current = -1) {
		if($max_it !== false)
			$this->max_item = $max_it;
		$this->count_item = count($itemList);
		$this->count = ceil(count($itemList)/$this->max_item);
		if(intval($current) > 0)
			$this->current = intval($current);
		if(intval($this->current) <= 0)
			$this->current = 0;
		if(intval($this->current) > intval($this->count) && $this->count > 0)
			$this->current = $this->count;
		$this->left = $this->count <= $this->max_page || $this->current <= ceil($this->max_page/2)
			? 1 : ($this->current<$this->count-floor($this->max_page/2)
							? $this->current - floor($this->max_page/2) : $this->count - $this->max_page + 1);
		$this->right = $this->left + $this->max_page - 1;
		$this->control_left = $this->current>ceil($this->max_page/2) && $this->left>1
			? true : false;
		$this->control_right = $this->current<$this->count-floor($this->max_page/2) && $this->right<$this->count
			? true : false;
		$this->items = array_slice($itemList, ($this->current - 1) * $this->max_item, $this->max_item);
		return $this->items;
	}

	function getSource($prefix="/p") {
		if($this->count <= 1) return '';
		$src = '<div id="pagination" class="row">';
		foreach(array('lg', '') as $value) {
			$src .= '<ul class="pagination pagination-'.$value.'">';
			if($this->current > 1) {
				$src .= '
					<li><a href="'.str_replace("/{$prefix}=", "{$prefix}=", getCurrentPageURL($prefix.'='.($this->current-1), false, false)).'">&lt;</a></li>';
			}
			else {
				$src .= '<li class="deactive"><a href="javascript:void(0);">&lt;</a></li>';
			}
			if($this->control_left) {
				$src .= '
					<li><a href="'.str_replace("/{$prefix}=", "{$prefix}=", getCurrentPageURL($prefix.'=1', false, false)).'">1</a></li>
					<li class="deactive"><a href="javascript:void(0);">...</a></li>';
			}
			for ($i=$this->left; $i<=$this->right && $i<=$this->count; $i++) {
				$active = $i==$this->current?' class="active"':'';
				$href = $i!=$this->current?sprintf(' href="%s"', str_replace("/{$prefix}=", "{$prefix}=", getCurrentPageURL($prefix.'='.$i, false, false))):'';
				$src .= '<li'.$active.'><a'.$href.'>'.$i.'</a></li>';
			}
			if($this->control_right) {
				$src .= '
					<li class="deactive"><a href="javascript:void(0);">...</a></li>
					<li><a href="'.str_replace("/{$prefix}=", "{$prefix}=", getCurrentPageURL($prefix.'='.($this->count), false, false)).'">'.$this->count.'</a></li>';
			}
			if($this->current < $this->count) {
				$src .= '
					<li><a href="'.str_replace("/{$prefix}=", "{$prefix}=", getCurrentPageURL($prefix.'='.($this->current+1), false, false)).'">&gt;</a></li>';
			}
			else {
				$src .= '<li class="deactive"><a href="javascript:void(0);">&gt;</a></li>';
			}
			$src .= '</ul>';
		}
		$src .= '</div>
			<style type="text/css">
				#pagination a {
					position: relative;
					color: #4A4641;
					background: #E6E6E6;
					border: none;
					border-radius: 50%;
					padding: 0;
					width: 40px;
					height: 40px;
					line-height: 40px;
					text-align: center;
				}
				#pagination li:not(.deactive):not(.active) a:after {
					content: "";
					position: absolute;
					top: 0; right:0;
					bottom: 0; left: 0;
					border-radius: 50%;
					transition: all .2s;
					-webkit-transition: all .2s;
				}
				#pagination li:not(.deactive):not(.active) a:hover:after {
					// background: rgba(0,0,0,.2);
					box-shadow: 0 0 5px #4A4641;
				}
				#pagination li:not(:last-child) a {
					margin-right: 10px;
				}
				#pagination a[href="javascript:void(0);"] {
					color: #B0B0B0;
					cursor: not-allowed;
				}
				#pagination .deactive {
					opacity: .7;
				}
				#pagination .active > a {
					position: relative;
					color: #fff;
					background: #4A4641;
				}
				#pagination {
					display: flex;
					justify-content: center;
				}
				#pagination .pagination- {
					display: none;
				}
				@media screen and (max-width: 767px) {
					#pagination .pagination- {
						display: block;
					}
					#pagination .pagination-lg {
						display: none;
					}
				}
			</style>';
		$this->source = $src;
		return $this->source;
	}
}
?>