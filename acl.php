<?
/**
 * @version 1.1
 * @author Reconnect
 */
class Acl
{
	var $user,$preset='',$db;
	var $users=array(),$roles=array(),$permissions=array();
	
  /**
	* 
	*/
	function Acl($db)
	{
       $this->db = mysql_connect($db['hostname'], $db['username'], $db['password'])or die(mysql_error());
       mysql_select_db($db['database'], $this->db)or die(mysql_error());
	}
	
	function setUser($identifier)
	{
		if(!empty($identifier))
		{
			$this->user = $identifier;
			
			# Check our Relations
			$q1 = mysql_query("SELECT * FROM aclpermissions", $this->db)or die(mysql_error());
			while($f1 = mysql_fetch_object($q1))
			{
				$this->permissions[$f1->roleId] = unserialize($f1->permissions);
			}
			
			# Check our Roles
			$q2 = mysql_query("SELECT * FROM aclroles WHERE identifier = '".$this->user."'", $this->db)or die(mysql_error());
			while($f2 = mysql_fetch_object($q2))
			{
				$this->roles = unserialize($f2->roles);
			}
		}
	}
	
	function setPermissions($role, $permissions)
	{
		$permissions = serialize($permissions);
		$permTable = $this->preset.'aclpermissions';
		# Where to check
		$where = " WHERE roleId = '".$role."'";
		
		# Check if Permissions Exist
		$check = mysql_query("SELECT * FROM ".$permTable." ".$where)or die(mysql_error());
		if(mysql_num_rows($check) == 1)
		{
			# If So, Update them
			mysql_query("UPDATE ".$permTable." set roleId = '".$role."', permissions = '".$permissions."' ".$where, $this->db)or die(mysql_error());
		}
		else
		{
			# Otherwise Create them
			mysql_query("INSERT INTO ".$permTable." (roleId, permissions) VALUES ('".$role."', '".$permissions."')", $this->db)or die(mysql_error());
		}
	}
	
	function setRole($uid, $roles)
	{
		$roles = serialize($roles);
		$permTable = $this->preset.'aclroles';
		# Where to check
		$where = " WHERE identifier = '".$uid."'";
		
		# Check if Permissions Exist
		$check = mysql_query("SELECT * FROM ".$permTable." ".$where, $this->db)or die(mysql_error());
		if(mysql_num_rows($check) == 1)
		{
			# If So, Update them
			mysql_query("UPDATE ".$permTable." set identifier = '".$uid."', roles = '".$roles."' ".$where, $this->db)or die(mysql_error());
		}
		else
		{
			# Otherwise Create them
			mysql_query("INSERT INTO ".$permTable." (identifier, roles) VALUES ('".$uid."', '".$roles."')", $this->db)or die(mysql_error());
		}
	}
	
	function setPreset($input)
	{
		$this->preset = $input;
	}
	
	# Methods
	function getRoles()
	{
		if(!empty($this->user))
		{
			return $this->roles;
		}
	}
	
	function hasAccess($permission)
	{
		if(!empty($this->user))
		{
			$roles = $this->getRoles();
			
			foreach($roles as $k => $role)
			{
				if(isset($this->permissions[$role]))
				{
					if(in_array($permission, $this->permissions[$role]))
					{
						return true;
					}
				}
			}
		}
	}
}

