<?php

	Router::connect(
		'/admin/plugins/importblockedu',
		[
			'plugin' => 'ImportBlockedUsers',
			'controller' => 'ImportBlockedUsers',
			'action' => 'import',
			'admin' => true
		]
	);
