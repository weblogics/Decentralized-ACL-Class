<?
# Database Connection
mysql_connect('localhost', 'admin_user', 'Trunks15')or die(mysql_error());
mysql_select_db('admin_acl')or die(mysql_error());

# ACL Class
include('acl.php');

$getUser = (isset($_GET['id'])) ? $_GET['id'] : null;

# Tell ACL which user to check
$acl = new Acl($getUser);

if($acl->hasAccess('admin_access') == true)
{
	echo '- User has access to Admin Only Areas<br />';
}

if($acl->hasAccess('premium_access') == true)
{
	echo '- User has access to Premium Only Areas<br />';
}

echo '- User has access to Members Only Areas<br />';

echo '- User has access to non-protected Areas<br />';