<?php

/**
 * @file plugins/generic/disableProfileImageUpload/DisableProfileImageUploadPlugin.inc.php
 *
 * Copyright (c) 2014-2022 Simon Fraser University
 * Copyright (c) 2003-2022 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class DisableProfileImageUploadPlugin
 * @ingroup plugins_generic_disableprofileimageupload
 *
 * @brief Disallows users from uploading images to their user profile.
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class DisableProfileImageUploadPlugin extends GenericPlugin
{
	/**
	 * @copydoc Plugin::register
	 */
	public function register($category, $path, $mainContextId = null)
	{
		$success = parent::register($category, $path, $mainContextId);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return $success;
		if ($success && $this->getEnabled()) {
			HookRegistry::register('publicprofileform::Constructor', [$this, 'constructorCallback']);
			HookRegistry::register('TemplateResource::getFilename', array($this, '_overridePluginTemplates'));
		}
		return $success;
	}

	/**
	 * @inheritDoc
	 */
	function getDisplayName()
	{
		return __('plugins.generic.disableProfileImageUpload.displayName');
	}

	/**
	 * @inheritDoc
	 */
	function getDescription()
	{
		return __('plugins.generic.disableProfileImageUpload.description');
	}

	function setEnabled($enabled)
	{
		parent::setEnabled($enabled);

		// Clear template cache when plugin is enabled to apply change immediately
		$templateMgr = TemplateManager::getManager(Application::get()->getRequest());
		$templateMgr->clearTemplateCache();
		$templateMgr->clearCssCache();
	}

	/**
	 * Unsets the PHP global $_FILES in the context of the ProfilePluginForm so no user profile images can be uploaded.
	 *
	 * @param string $hookName
	 * @param array $args
	 * @return bool
	 */
	function constructorCallback(string $hookName, array $args): bool
	{
		if (isset($_FILES)) {
			unset($_FILES);
		}

		return false;
	}
}
