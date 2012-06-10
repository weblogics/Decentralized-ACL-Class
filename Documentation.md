# Decentralized ACL Class
					
The ACL class was designed to do nothing other then do Access Control.
The goal is that this Access Control List is completely decentralized, and therefor it is no tailored to any particular membership script.
___

## Installation

This is a basic PHP Class. So to use this, all you have to do is the following:

- Download and Unzip File
- Copy **acl.php** to your directory of choosing.
- Use PHP to include the file.

    ```php
	# Database Connection
    $db['host'] = 'localhost';
    $db['user'] = 'username';
    $db['pass'] = 'password';
    $db['database'] = 'database';
    
    # ACL Class
    include('acl.php');
    
    # Pass on the Database information
    $acl = new Acl($db);
	```

- Execute **tables.sql** in your PHPMyAdmin or other SQL Management tool.


___
### Basic Usage

When you create an ACL Object, you must pass on the User's unique user id. Then you can use the Object to manipulate or request information about what this user can do.

    # Tell ACL which user to check
    $acl->setUser(1);

An access control requires 3 Resources.

- Users
- Roles
- Permissions

In order for us to allow users to view the pages with the correct permissions, we simply do the following:

- **Permissions are assigned to **Roles
- **Roles are assigned to **Users

But make no mistake, these resources can be controlled outside bounds. The Access Control List is Decentralized. Which means, it tells your script who has access to what. But it does not actually manage those resources itself.
___
### Manipulate Permissions of Roles

You cannot see the workings of the script if no one has permissions to do anything of course.
Here we update the Permissions of **Role 1**.

    $permissions = array('admin_access','premium_access');
    
    $acl->setPermissions(1, $permissions);

Now, any user that is given the **Role 1 has access to view pages that are protected by these permissions.
Please note that you only have to do this once, after the execution. Role 1 still has these permssions stored, and calling this function will update the role with the new array.
___

### Manipulate Roles of Users

Here we update the roles of **User 1**.

    $roles = array(2,3);
    
    $acl->setRole(1, $roles);

Now, **User 1** has access to view pages that are protected by the permissions that Role 1 and Role 2 have.
Please note that you only have to do this once, after the execution. User 1 still has these permssions stored, and calling this function will update the Roles with the new array.
___

### Check Permissions

You can easily check if the user has access to the permissions to access something.

    # Check if user has Permissions to access admin_access
    if($acl->hasAccess('admin_access'))
    {
        echo '- User has access to Admin Only Areas';
    }