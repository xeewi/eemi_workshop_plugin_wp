<div class="wrap" id="wpSM">
	
	<h2>
		<a href="?page=wpsm.dashboard">
			<img src="<?php echo WP_PLUGIN_URL . '/wpSlackManager/asset/img/icon.svg'; ?>">
			slack <span>Manager</span>
		</a>
	</h2>

	<p>
		<a class="ps" href="admin.php?page=wpsm.dashboard"> <?php echo __( 'Home', 'wpSlackManager' ); ?> </a> >
		<?php echo __( 'Users', 'wpSlackManager' ); ?>
	</p>

	<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/menu.php' ); ?>

	<div id="content">
		<h3>
			<i class="fa fa-users red-text" aria-hidden="true"></i> 
			<?php echo __( 'All users', 'wpSlackManager' ); ?>
		</h3>

		<div class="panel-head">
			<a href="?page=wpsm.users" class="panel-option selected"><?php echo __('Full users', 'wpSlackManager'); ?></a>
		</div>
		<div class="panel">
			<?php foreach ($users as $key => $user) { ?>
				<div class="panel-list">
					<a href="?page=wpsm.users.info&user_id=<?php echo $user->id ?>">
						<img class="thumb-72" src="<?php echo $user->profile->image_72 ?>">
					</a>
					<div>
						<h4><?php echo $user->profile->real_name_normalized; ?></h4>
						<p>
							@<?php echo $user->name; ?>
							<?php if( isset( $user->presence ) && $user->presence == "active" ){ ?>
								<i class="fa fa-circle green-text" aria-hidden="true"></i>
							<?php } ?>
							<?php if( isset( $user->presence ) && $user->presence == "away" ){ ?>
								<i class="fa fa-circle-o grey-light-text" aria-hidden="true"></i>
							<?php } ?>
						</p>

						<?php if ( isset( $user->profile->bot_id ) || $user->id == "USLACKBOT" ) { ?>
							<p><i class="fa fa-bolt" aria-hidden="true"></i> BOT</p>
						<?php } ?>
					</div>
					<div class="action">
						<a class="btn btn_outline" href="?page=wpsm.users.info&user_id=<?php echo $user->id ?>">
							<?php echo __( 'See more', 'wpSlackManager' ); ?>
						</a>
					</div>
				</div>
			<?php }  ?>
		</div>
	</div>
</div>