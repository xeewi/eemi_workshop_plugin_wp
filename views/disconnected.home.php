<div class="wrap">

	<h2>Slack Manager</h2>
	
	<p><?php echo __( 'Click to connect your Slack account !', 'wpSlackManager' ); ?></p>

	<p>
		<a href="https://slack.com/oauth/authorize?scope=identity.basic,identity.team&client_id=<?php echo $this->_client_id; ?>">
			<img src="https://api.slack.com/img/sign_in_with_slack.png" />
		</a>
	</p>

</div>