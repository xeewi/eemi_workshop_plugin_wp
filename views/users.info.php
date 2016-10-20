<div class="wrap" id="wpSM">
	
	<h2>
		<img src="<?php echo WP_PLUGIN_URL . '/wpSlackManager/asset/img/icon.svg'; ?>">
		slack <span>Manager</span>
	</h2>

	<!--	Error alerts
	<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>> -->
	<?php if ( isset($error) ) { ?>
		<div class="alert error">
			<p>
				<i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
				<?php echo __( "Can't edit user informations !", "wpSlackManager" ); ?>
			</p>
		</div>
	<?php } ?>


	<!--	Success alerts
	<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>> -->
	<?php if ( isset($success) ) { ?>
		<div class="alert success">
			<p>
				<i class="fa fa-check-circle-o" aria-hidden="true"></i> 
				<?php echo __( "User edited !", "wpSlackManager" ); ?>
			</p>
		</div>
	<?php } ?>
	
	<p>
		<a class="ps" href="admin.php?page=wpsm.dashboard"> <?php echo __( 'Home', 'wpSlackManager' ); ?> </a> >
		<a class="ps" href="admin.php?page=wpsm.users"> <?php echo __( 'Users', 'wpSlackManager' ); ?> </a> >
		Info
	</p>

	<?php require_once( 'users.menu.php' ); ?>

	<div id="content">
		<h3>
			<i class="fa fa-user red-text" aria-hidden="true"></i> 
			<?php echo __( 'User info', 'wpSlackManager' ); ?>
		</h3>

		<div class="panel-actions panel-list">
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

				<?php if ( isset( $user->profile->bot_id ) || strstr( $user->id, "SLACKBOT"  ) ) { ?>
					<p><i class="fa fa-bolt" aria-hidden="true"></i> BOT</p>
				<?php } ?>
			</div>
		</div>
		<div class="panel">
			<?php if( !isset( $user->profile->bot_id ) && !strstr( $user->id, "SLACKBOT" ) ) { ?>
			<form action="admin-post.php" method="POST">
				<input type="hidden" name="action" value="edit_user_profile">
				<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
				<label><?php echo __('First name', 'wpSlackManager'); ?></label>
				<input type="text" 
					name="profile[first_name]" 
					value="<?php if( isset( $user->profile->first_name ) ){ echo $user->profile->first_name; } ?>">

				<label><?php echo __('Last name', 'wpSlackManager'); ?></label>
				<input type="text" 
					name="profile[last_name]" 
					value="<?php if( isset( $user->profile->last_name ) ){ echo $user->profile->last_name; } ?>">

				<label><?php echo __('Email', 'wpSlackManager'); ?></label>
				<input type="email" 
					name="profile[email]" 
					value="<?php if( isset( $user->profile->email ) ){ echo $user->profile->email; } ?>">

				<label><?php echo __('Skype', 'wpSlackManager'); ?></label>
				<input type="text" 
					name="profile[skype]" 
					value="<?php if( isset( $user->profile->skype ) ){ echo $user->profile->skype; } ?>">
				<button action="submit" class="btn action" >Edit</button>
			</form>
			<?php } ?>
			<a class="btn btn_outline" href="?page=wpsm.users">Back</a>
		</div>
	</div>

</div>