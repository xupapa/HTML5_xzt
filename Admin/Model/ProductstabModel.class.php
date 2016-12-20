<?php
	namespace Admin\Model;
	use Think\Model;
	class ProductstabModel extends Model{
		public $_validate=array(
			array("pname","requre","商品名不得为空"),
			array("price","require","价格不得为空"),
			array("pnum","reuqire","商品数量不得为空")
		);
	}
?>