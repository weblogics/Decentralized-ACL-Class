<h1 class="entry-title">Decentralized ACL Class</h1>
					
<p>The ACL class was designed to do nothing other then do Access Control.</p>
<p>The goal is that this Access Control List is completely decentralized, and therefor it is no tailored to any particular membership script.</p>

<h2 id="toc" class="alt">Table of Contents</h2>
<ol class="alpha">
<li><a href="#a">Installation</a></li>
<li><a href="#b">Basic Usage</a></li>
<li><a href="#c">Manipulate Permissions of Roles</a></li>
<li><a href="#d">Manipulate Roles of Users</a></li>
<li><a href="#e">Check Permissions</a></li>
<li><a href="#f">Final Notes</a></li>
</ol>

<hr class="dotted" />

<h3 id="a"><strong>Installation</strong> &#8211; <a href="#toc">top</a></h3>

<p>This is a basic PHP Class. So to use this, all you have to do is the following:</p>

<ul>
<li>Download and Unzip File</li>
<li>Copy <strong>acl.php</strong> to your directory of choosing.</li>
<li>Use PHP to include the file.</li>
</ul>

<pre># Database Connection
$db['host'] = 'localhost';
$db['user'] = 'username';
$db['pass'] = 'password';
$db['database'] = 'database';

# ACL Class
include('acl.php');

# Pass on the Database information
$acl = new Acl($db);</pre>

<ul>
<li>Execute <em>tables.sql</em> in your PHPMyAdmin or other SQL Management tool.</li>
</ul>

<hr class="dotted" />
<h3 id="b"><strong>Basic Usage</strong> &#8211; <a href="#toc">top</a></h3>

<p>When you create an ACL Object, you must pass on the User&#8217;s unique user id. Then you can use the Object to manipulate or request information about what this user can do.</p>

<pre># Tell ACL which user to check
$acl->setUser(1);</pre>

<p>An access control requires 3 Resources.</p>

<ul>
<li>Users</li>
<li>Roles</li>
<li>Permissions</li>
</ul>

<p>In order for us to allow users to view the pages with the correct permissions, we simply do the following:</p>

<ul>
<li><strong>Permissions</strong> are assigned to <strong>Roles</strong></li>
<li><strong>Roles</strong> are assigned to <strong>Users</strong></li>
</ul>

<p>But make no mistake, these resources can be controlled outside bounds. The Access Control List is Decentralized. Which means, it tells your script who has access to what. But it does not actually manage those resources itself.</p>

<hr class="dotted" />
<h3 id="c"><strong>Manipulate Permissions of Roles</strong> &#8211; <a href="#toc">top</a></h3>

<p>You cannot see the workings of the script if no one has permissions to do anything of course.</p>
<p>Here we update <strong>Role 1</strong>&#8216;s Permissions.</p>

<pre>$permissions = array('admin_access','premium_access');

$acl->setPermissions(1, $permissions);</pre>

<p>Now, any user that is given the <strong>Role 1</strong> has access to view pages that are protected by these permissions.</p>
<p>Please note that you only have to do this once, after the execution. Role 1 still has these permssions stored, and calling this function will update the role with the new array.</p>

<hr class="dotted" />
<h3 id="d"><strong>Manipulate Roles of Users</strong> &#8211; <a href="#toc">top</a></h3>

<p>Here we update <strong>User 1</strong>&#8216;s Roles.</p>

<pre>$roles = array(2,3);

$acl->setRole(1, $roles);</pre>

<p>Now, <strong>User 1</strong> has access to view pages that are protected by the permissions that Role 1 and Role 2 have.</p>
<p>Please note that you only have to do this once, after the execution. User 1 still has these permssions stored, and calling this function will update the Roles with the new array.</p>

<hr class="dotted" />
<h3 id="e"><strong>Check Permissions</strong> &#8211; <a href="#toc">top</a></h3>

<p>You can easily check if the user has access to the permissions to access something.</p>

<pre># Check if user has Permissions to access admin_access
if($acl->hasAccess('admin_access'))
{
    echo '- User has access to Admin Only Areas';
}</pre>

<hr class="dotted" />

<h3 id="f"><strong>Final Notes</strong> &#8211; <a href="#toc">top</a></h3>

<p>Reconnect is always glad to help you if you have any questions relating to this product.</p> 

<p><a href="#toc">Go To Table of Contents</a></p>