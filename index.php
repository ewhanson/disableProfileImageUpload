<?php

/**
 * @defgroup plugins_generic_disableprofileimageupload
 */

/**
 * @file plugins/generic/disableProfileIMageUpload/index.php
 *
 * Copyright (c) 2014-2022 Simon Fraser University
 * Copyright (c) 2003-2022 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_generic_disableprofileimageupload
 * @brief Wrapper for the Disable Profile Image Upload plugin.
 *
 */
require_once('DisableProfileImageUploadPlugin.inc.php');

return new DisableProfileImageUploadPlugin();

?>
