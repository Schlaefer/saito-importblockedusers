<?php

	SaitoEventManager::getInstance()->attach(
		'Request.Saito.View.Admin.plugins', function () {
			$url = '/admin/plugins/importblockedu';
			$title = 'Import Blocked Users';
			return compact('url', 'title');
		}
	);