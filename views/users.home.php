<div class="wrap" id="wpSM">
	
	<h2>
		<img src="<?php echo WP_PLUGIN_URL . '/wpSlackManager/asset/img/icon.svg'; ?>">
		slack <span>Manager</span>
	</h2>

	<p>
		<a class="ps" href="admin.php?page=wpsm.dashboard"> <?php echo __( 'Home', 'wpSlackManager' ); ?> </a> >
		<?php echo __( 'Users', 'wpSlackManager' ); ?>
	</p>

	<?php require_once( 'users.menu.php' ); ?>

	<div id="content">
		<h3>
			<i class="fa fa-users red-text" aria-hidden="true"></i> 
			<?php echo __( 'All users', 'wpSlackManager' ); ?>
		</h3>

		<div class="panel-head">
			<a href="#" class="panel-option selected"><?php echo __('Full users', 'wpSlackManager'); ?></a>
		</div>
		<div class="panel">
			<?php foreach ($users as $key => $user) { ?>
				<?php $profile = $user->profile(); ?>
				<div class="panel-list">
					<img class="thumb-72" src="<?php echo $profile['image_72'] ?>">
					<div>
						<h4><?php echo $profile['real_name_normalized']; ?></h4>
						<p>
							@<?php echo $user->name(); ?>
							<?php if( $user->presence() == "active" ){ ?>
								<i class="fa fa-circle green-text" aria-hidden="true"></i>
							<?php } ?>
							<?php if( $user->presence() == "away" ){ ?>
								<i class="fa fa-circle-o grey-light-text" aria-hidden="true"></i>
							<?php } ?>
						</p>

						<?php if ( isset( $profile['bot_id'] ) || $user->id() == "USLACKBOT" ) { ?>
							<p><i class="fa fa-bolt" aria-hidden="true"></i> BOT</p>
						<?php } ?>
					</div>
				</div>
			<?php }  ?>
		</div>
	</div>
</div>