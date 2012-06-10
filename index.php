<?
# Database Connection
$config['hostname'] = 'localhost';
$config['username'] = 'username';
$config['password'] = 'password';
$config['database'] = 'database';

# ACL Class
include('acl.php');

# Pass on the Database information
$acl = new Acl($config);

# Get information via URL
$getUser = (isset($_GET['id'])) ? $_GET['id'] : null;

# Tell ACL which user to check
$acl->setUser($getUser);

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