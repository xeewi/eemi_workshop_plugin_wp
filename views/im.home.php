<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/includes/header.include.php'  ); ?>

	<p>
		<a class="ps" href="admin.php?page=wpsm.dashboard"> <?php echo __( 'Home', 'wpSlackManager' ); ?> </a> >
		<?php echo __( 'Direct message', 'wpSlackManager' ); ?> :
		@<?php echo $user->name; ?>
	</p>

	<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/includes/menu.include.php' ); ?>

	<div id="content">
		
		<h3>
			<i class="blue-text fa fa-comments-o" aria-hidden="true"></i>
			<?php echo __( 'Direct messages', 'wpSlackManager' ); ?>
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
		<div class="panel messages" id="chat">
			<div class="content" >
				<?php foreach ($messages as $key => $message) { ?>
				<div>
					<p style="color:#<?php echo $message->user->color ?>;" ><?php echo $message->user->name ?></p>
					<p><?php echo $message->text ?></p>
				</div>
				<?php } ?>		
			</div>
			<form id="wpsm_send">
				<input class="small" type="text" name="message" placeholder="Message">
			</form>
		</div>

	</div>

<?php require_once( WP_PLUGIN_DIR . '/wpSlackManager/views/includes/footer.include.php'  ); ?>