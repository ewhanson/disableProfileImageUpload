{**
 * templates/user/publicProfileForm.tpl
 *
 * Copyright (c) 2014-2022 Simon Fraser University
 * Copyright (c) 2003-2022 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Public user profile form.
 *}

{* Help Link *}
{help file="user-profile" class="pkp_help_tab"}

<script type="text/javascript">
	$(function() {ldelim}
		// Attach the form handler.
		$('#publicProfileForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
        {rdelim});
</script>

<form class="pkp_form" id="publicProfileForm" method="post" action="{url op="savePublicProfile"}" enctype="multipart/form-data">
    {csrf}

    {include file="controllers/notification/inPlaceNotification.tpl" notificationId="publicProfileNotification"}

	{* Profile image upload section removed for plugin *}

    {fbvFormSection}
    {fbvElement type="textarea" label="user.biography" multilingual="true" name="biography" id="biography" rich=true value=$biography}
    {/fbvFormSection}
    {fbvFormSection}
    {fbvElement type="text" label="user.url" name="userUrl" id="userUrl" value=$userUrl maxlength="255"}
    {/fbvFormSection}
    {fbvFormSection}
    {fbvElement type="text" label="user.orcid" name="orcid" id="orcid" value=$orcid maxlength="37"}
    {/fbvFormSection}

    {call_hook name="User::PublicProfile::AdditionalItems"}

	<p>
        {capture assign="privacyUrl"}{url router=$smarty.const.ROUTE_PAGE page="about" op="privacy"}{/capture}
        {translate key="user.privacyLink" privacyUrl=$privacyUrl}
	</p>

	<p><span class="formRequired">{translate key="common.requiredField"}</span></p>

    {fbvFormButtons hideCancel=true submitText="common.save"}
</form>
