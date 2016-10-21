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
	<h4><?php echo __( 'Direct messages', 'wpSlackManager' ); ?></h4>
	<?php if ( isset( $menu['ims'] ) && is_array( $menu['ims'] ) ) { ?>
		<?php 
		foreach ( $menu['ims'] as $key => $im ) { 
			$class = "btn_list user";
			if ( isset( $menu['im_selected'] ) && $menu['im_selected'] == $im->id ){
				$class = "btn_list user active";
			} 
		?>
			<a class="<?php echo $class; ?>" href="?page=wpsm.im&channel=<?php echo $im->id; ?>&user=<?php echo $im->user->id; ?>&wpsm_token=<?php echo $menu['wpsm_token']; ?>">
				<?php if( $im->user->presence == "active" ){ ?>
				<i class="green-text fa fa-circle" aria-hidden="true"></i>
				<?php } else { ?>
				<i class="grey-light-text fa fa-circle-o" aria-hidden="true"></i>
				<?php } ?>
				<?php echo $im->user->name; ?>
			</a>	
		<?php }  ?>
	<?php } else { ?>
	<p><?php echo __( 'No direct message', 'wpSlackManager' ); ?></p>
	<?php } ?>
	
</div>
<?php } ?>