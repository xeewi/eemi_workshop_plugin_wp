<?php if ( isset($menu) && is_array( $menu ) ){ ?>
<div id="menu">

	<h3><?php echo __( 'Menu', 'wpSlackManager' ); ?></h3>

	<a class="btn_list <?php if( $menu['page'] == "dashboard" ) { echo "green_active"; } ?> " 
		href="?page=wpsm.dashboard">
		<i class="green-text fa fa-tachometer" aria-hidden="true"></i>
		<?php echo __( 'Dashboard', 'wpSlackManager' ); ?>
	</a>

	<a class="btn_list <?php if( $menu['page'] == "users" ) { echo "red_active"; } ?> " 
		href="?page=wpsm.users">
		<i class="red-text fa fa-users" aria-hidden="true"></i>
		<?php echo __( 'Users', 'wpSlackManager' ); ?>
	</a>

	<h4><?php echo __( 'Channels', 'wpSlackManager' ); ?></h4>
	<p>Coming soon</p>
	<h4><?php echo __( 'Private messages', 'wpSlackManager' ); ?></h4>
	<p>Coming soon</p>
	
</div>
<?php } ?>