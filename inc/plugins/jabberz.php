<?php

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.");
}


function jabberz_info()
{
	return array(
		"name"			=> "Add Jabber Functionality",
		"description"	=> "Adds options to have Jabber instead of Email",
		"website"		=> "http://jb-networks.co.uk",
		"author"		=> "jb",
		"authorsite"	=> "http://jb-networks.co.uk",
		"version"		=> "1.0",
		"guid" 			=> "",
		"codename"		=> "",
		"compatibility" => "*"
	);
}

function jabberz_install()
{
	require_once MYBB_ROOT."/inc/adminfunctions_templates.php";
	/*
	global $db, $mybb, $templates;
	$settings_group = array(
    	'name' => 'jabberz',
    	'title' => 'Jabber Mods',
    	'description' => 'This is my plugin and it does some things',
    	'disporder' => 6, // The order your setting group will display
    	'isdefault' => 0
	);
	$gid = $db->insert_query("settinggroups", $settings_group);
	$setting_array = array(
    	'jabberz_enable' => array(
        	'title' => 'Jabber Mod',
        	'description' => 'Do we want to activate this plugin?:',
        	'optionscode' => 'yesno',
        	'value' => '1', // Default
        	'disporder' => 1
    	),
	);
	foreach($setting_array as $name => $setting)
	{
    	$setting['name'] = $name;
    	$setting['gid'] = $gid;
	    $db->insert_query('settings', $setting);
	}
	rebuild_settings();
	*/
	find_replace_templatesets("member_lostpw", "#" . preg_quote('<td class="trow1" width="60%"><input type="text" class="textbox" name="email" />') . "#i", '<td class="trow1" width="60%"><input type="text" class="textbox" name="email" /></td><tr><td class="trow2" width="40%"><strong>Jabber Address:</strong></td><td class="trow2" width="60%"><input type="text" class="textbox" name="jabber" />');
	find_replace_templatesets("member_profile", "#" . preg_quote('<td class="{$bgcolors[\'yahoo\']}"><strong>{$lang->yahoo_id}</strong></td>') . "#i", '<td class="{$bgcolors[\'yahoo\']}"><strong>Jabber ID:</strong></td>');
}

function jabberz_is_installed()
{
	global $mybb;
	if($mybb->settings["jabberz_enable"])
	{
		return true;
	}
	return false;
}

function jabberz_uninstall()
{
	global $db;

	$db->delete_query('settings', "name IN ('jabberz_enable')");
	$db->delete_query('settinggroups', "name = 'jabberz'");
	rebuild_settings();
	find_replace_templatesets("member_lostpw", "#" . preg_quote('<td class="trow1" width="60%"><input type="text" class="textbox" name="email" /></td><tr><td class="trow2" width="40%"><strong>Jabber Address:</strong></td><td class="trow2" width="60%"><input type="text" class="textbox" name="jabber" />') . "#i", '<td class="trow1" width="60%"><input type="text" class="textbox" name="email" />');
	find_replace_templatesets("member_profile", "#" . preg_quote('<td class="{$bgcolors[\'yahoo\']}"><strong>Jabber ID:</strong></td>') . "#i", '<td class="{$bgcolors[\'yahoo\']}"><strong>{$lang->yahoo_id}</strong></td>');
}

function jabberz_activate()
{

}

function jabberz_deactivate()
{

}
