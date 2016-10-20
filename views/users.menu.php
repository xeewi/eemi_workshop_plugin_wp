<div id="menu">

	<h3><?php echo __( 'Users', 'wpSlackManager' ); ?></h3>

	<a class="btn_list <?php if ( $page == "all" ) { echo "active red-bg"; } ?> " href="">
		<i class="fa fa-users" aria-hidden="true"></i>
		<?php echo __( 'All', 'wpSlackManager' ); ?>
	</a>
	<a class="btn_list <?php if ( $page == "add" ) { echo "active red-bg"; } ?>" href="">
		<i class="fa fa-user-plus" aria-hidden="true"></i>
		<?php echo __( 'Add', 'wpSlackManager' ); ?>
	</a>
</div>