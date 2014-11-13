<?php

	class ImportBlockedUsersController extends ImportBlockedUsersAppController {

		public $uses = ['User'];

		public function admin_import() {
			//= get all blocked users
			$all = $this->User->find('all', [
				'contain' => false,
				'conditions' => [
					'User.user_lock' => true
				]
			]);

			if (empty($all)) {
				return;
			}

			//= get all new blocked users
			$newBlocks = $this->User->UserBlock->getAllActive();
			$new = [];
			foreach ($newBlocks as $block) {
				$userId = (int)$block['UserBlock']['user_id'];
				$new[$userId] = $userId;
			}

			//= compare
			$toUpdate = [];
			foreach ($all as $user) {
				$userId = (int)$user['User']['id'];
				if (isset($new[$userId])) {
					continue;
				}
				$toUpdate[$userId] = $user['User'];
			}

			//= action
			if ($this->request->is('post')) {
				try {
					foreach ($toUpdate as $key => $user) {
						$this->User->UserBlock->block(
							new \Saito\User\Blocker\ManualBlocker,
							$key,
							['adminId' => $this->CurrentUser->getId()]
						);
						unset($toUpdate[$key]);
					}
					$this->JsData->addAppJsMessage('Success', ['element' => 'flash/render', 'type' => 'success']);
				} catch (Exception $e) {
					$this->JsData->addAppJsMessage('Error while importing.', ['element' => 'flash/render', 'type' => 'success']);
				}
			}

			$this->set(compact('toUpdate'));
		}

		public function beforeFilter() {
			$this->layout = 'admin';

			$version = Configure::read('Saito.v');

			if (!version_compare($version, $this->_minSaitoVersion, '>=')) {
				$this->set('requirements',
					['is' => $version, 'needs' => $this->_minSaitoVersion]);
			}
		}

	}