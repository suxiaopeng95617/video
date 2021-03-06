<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace web\home\controller;

class Goods {
	protected $db;

	public function __construct() {
		$this->db = new \system\model\Goods();
	}

	//列表
	public function lists() {
		View::with( 'data', $this->db->get() );
		View::make();
	}

	//编辑
	public function post() {
		if ( IS_POST ) {
			$action = q( 'get.id' ) ? 'save' : 'add';
			if ( $this->db->$action() ) {
				message( '保存成功', 'lists', 'success' );
			}
			message( $this->db->getError(), '', 'error' );
		}
		View::with( 'category', Db::table( 'category' )->get() );
		View::with( 'field', $this->db->find( q( 'get.id' ) ) );
		View::make();
	}

	//删除
	public function del() {
		if ( $this->db->del( q( 'get.id' ) ) ) {
			message( '删除成功', 'lists', 'success' );
		}
		message( $this->db->getError(), '', 'error' );
	}
}