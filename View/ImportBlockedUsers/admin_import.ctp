<?php
	$this->Html->addCrumb(__('Plugins'), '/admin/plugins');
	$this->Html->addCrumb('Import Blocked Users', '/admin/plugins');

	echo $this->Html->tag('h1', 'Import Blocked Users');
	echo $this->Html->para(null,
		'Import blocked user from a pre Saito 4.4 installation into the new blocking system of Saito 4.4+.');

	if (isset($requirements)) {
		echo $this->Html->para(
			['class' => 'text-error'],
			'This plugin needs at least Saito ' . $requirements['needs'] . '.'
		);
		return;
	}

	if (empty($toUpdate)) {
		echo $this->Html->para(['class' => 'text-success'],
			'Everything looks fine. No users to import found.');
		return;
	}

	echo $this->Html->para(null, 'The following users will be imported:');
	$list = [];
	foreach ($toUpdate as $user) {
		$list[] = $this->Layout->linkToUserProfile($user, $CurrentUser);
	}
	echo $this->Html->nestedList($list);

	echo $this->Form->postLink('Import', null, [
		'class' => 'btn btn-warning'
	]);

