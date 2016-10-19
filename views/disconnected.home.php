<div class="wrap" id="wpSM">

	<h2><i class="fa fa-slack" aria-hidden="true"></i> Slack Manager</h2>

	<?php if ( isset($post_error) ) { ?>
		<div class="alert error">
			<p>
				<i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
				<?php echo __( "Missing Client ID or Client Secret !", "wpSlackManager" ); ?>
			</p>
		</div>
	<?php } ?>

	<?php if ( isset($post_success) ) { ?>
		<div class="alert success">
			<p>
				<i class="fa fa-check-circle-o" aria-hidden="true"></i>
				<?php echo __( "Client ID and Client Secret added !", "wpSlackManager" ); ?>
			</p>
		</div>
	<?php } ?>
	
	<div class="card">
		<h3><?php echo __( 'Step 1 : Create your app', "wpSlackManager" ); ?></h3>
		<p class="ps"><?php echo __( '* If you already got a Slack APP, you can skip this Step and directly go to Step 2', 'wpSlackManager' ); ?></p>
		<p><?php echo __( 'You need a Slack APP to use Slack Manager.', 'wpSlackManager' ); ?></p>
		<p><?php echo __( 'Simply create it by clicking on the following link, and get yours Client ID and Client Secret. After creating your app, come back here for Step 2.', 'wpSlackManager' ); ?></p>
		<p><?php echo __( 'Click here to create your Slack App !', "wpSlackManager" ); ?></p>
		<p class="action">
			<a target="_blank" class="btn" href="https://api.slack.com/apps?new_app=1"> 
				<i class="fa fa-slack" aria-hidden="true"></i> 
				<?php echo __('Create App', "wpSlackManager" ); ?>
			</a>
		</p>
	</div>

	<div class="card">
		<h3><?php echo __( "Step 2 : Add Return URI to your Slack App", "wpSlackManager" ); ?></h3>
		<p class="ps" > <a target="_blank" href="https://api.slack.com/apps"><?php echo __( "Select your app", "wpSlackManager" ); ?></a> > OAuth & Permissions </p>
		<p><?php echo __("Copy and paste the following return URI to your Slack App.", "wpSlackManager" ); ?></p>
		<form>
			<label for="return_uri" >Return URI</label>
			<input type="text" readonly name="return_uri" value="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=wpsm.return_uri">
		</form>
	</div>

	<div class="card">
		<h3><?php echo __( "Step 3 : Add yours Client ID and Client Secret" ,'wpSlackManager' ); ?></h3>
		<p>Paste here your Client ID and Secret</p>
		<form method="POST" action="admin-post.php">
			<input type="hidden" name="action" value="add_clients_discnt">
			<label for="client_id">Client ID</label>
			<input type="text" name="client_id" class="small" value="<?php echo $this->_token->client_id(); ?>">
			<label for="client_secret">Client Secret</label>
			<input type="password" name="client_secret" class="small" value="<?php echo $this->_token->client_secret(); ?>">
			<p class="action"><button action="submit" class="btn" >Edit</button></p>
		</form>
	</div>

	<div class="card">
		<h3><?php echo __( "Step 4 : Connect to your account", "wpSlackManager" ); ?></h3>
		<?php if ( $this->_token->client_id() ) {  ?>
			<p><?php echo __( 'Click to connect your Slack account !', 'wpSlackManager' ); ?></p>
			<p>
				<a href="https://slack.com/oauth/authorize?scope=identity.basic,identity.team&client_id=<?php echo $this->_token->client_id(); ?>">
					<img src="https://api.slack.com/img/sign_in_with_slack.png" />
				</a>
			</p>
		<?php } else { ?>
			<p><?php echo __( "Complete Step 3 before connect your account !", "wpSlackManager" ) ?></p>
		<?php } ?>
	</div>
	
</div>