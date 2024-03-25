<?php

class UserDB {

    /**
     * Get the user with by the usrename
     * @param $username
     */
    public function getRecord(string $username){
        global $DB;
        return $DB->get_record('user', array('username' => $username));
    }

    /**
     * Get the user by id
     * @param $id
     */
    public function getUserById(int $id){
        global $DB;
        return $DB->get_record('user', array('id' => $id));
    }

    /**
     * Get the users
     */
    public function getUsers(): array{
        global $DB;
        return $DB->get_records('user');
    }


    /**
     * create a random password
     */
    public final function RandomPassword() {
        $uppercase = range('A', 'Z');
        $lowercase = range('a', 'z');
        $numbers = range(0, 9);
        $special_chars = array('!', '@', '#', '$', '%', '^', '&', '*');
        $characters = array_merge($uppercase, $lowercase, $numbers, $special_chars);
    
        shuffle($characters);
    
        $password = '';
        $password .= $uppercase[array_rand($uppercase)];
        $password .= $lowercase[array_rand($lowercase)];
        $password .= $numbers[array_rand($numbers)];
        $password .= $special_chars[array_rand($special_chars)];
    
        for ($i = 0; $i < 4; $i++) {
            $password .= $characters[array_rand($characters)];
        }
    
        return str_shuffle($password);
    }

    /**
     * Check if the username is already used
     * @param $username
     */
    public function checkUserName(String $username) : String {
        global $DB;
        $user = $DB->get_record('user', array('username' => $username));
        $i = 1;
        $TMPusername = $username;
        while ($user != false) {
            $TMPusername = $username . $i;
            $user = $DB->get_record('user', array('username' => $TMPusername));
            $i += 1;

        }

        return $TMPusername;
    }

    /**
     * Add a user
     * @param $firstName
     * @param $lastName
     * @param $role
     * @param $groupName
     */
    public function addUser(String $firstName, String $lastName, int $role = 4, String $groupName = 'Aucune'): array{
        $user = new stdClass();
        $user->firstname =  $firstName;
        $user->lastname = $lastName;
        $user->username = $this->checkUserName(strtolower(substr($firstName,0,1) . preg_replace('/[^a-zA-Z]/', '', $lastName)));
        $user->password = $this->RandomPassword();
        $password = $user->password;
        $user->email = $firstName."." . $lastName . "@balabox.home" ;
        $user->auth = 'manual';
        $user->confirmed = 1;
        $user->lang = 'fr';
        $user->timecreated = time();
        $user->timemodified = time();
        $user->id = user_create_user($user);
        role_assign($role, $user->id, context_system::instance());
        
        if ($groupName != 'Aucune') {
            $groupsDB = new GroupsDB();
            $group = $groupsDB->getGroup($groupName);
            $groupsDB->addMember($group->id, $user->username);
        }
        return array($user->username, $password,$role);
        }

        public function basicUser(int $nbGuest = 50) : void {
            set_config('passwordpolicy', 0);
            for ($i = 0; $i < $nbGuest; $i++) {
                $user = new stdClass();
                $user->firstname =  "g" . $i;
                $user->lastname = "g" . $i;
                $user->username = "g" . $i;
                $user->password = "g" . $i;
                $user->email = "g" . $i . "@balabox.home" ;
                $user->auth = 'manual';
                $user->confirmed = 1;
                $user->lang = 'fr';
                $user->timecreated = time();
                $user->timemodified = time();
                $user->id = user_create_user($user);
                role_assign(4, $user->id, context_system::instance());
            }
            set_config('passwordpolicy', 1);
        }

        /**
         * Add a role to a user
         * @param $username
         * @param $role
         */
    public function addRolesSystemMembers(String $username, String $role): void{
        global $DB;
        $user = $DB->get_record('user', array('username' => $username));
        $role = $DB->get_record('role', array('shortname' => $role));
        role_assign($role->id, $user->id, context_system::instance());
    }

    public function deleteRole(String $username) : void {
        global $DB;
        $user = $this->getRecord($username);
        $DB->delete_records('role_assignments', array('userid' => $user->id));
    }
    
    /**
     * Get the role of a user
     * @param $username
     */
    public function getUser_role(string $username) {
    	global $DB;
    	$user = $this->getRecord($username);
	    $roles =$DB->get_record('role_assignments', array('userid' => $user->id));
    	return  $roles->roleid;
    }

    /**
     * Get the group of a user
     * @param $username
     */
    public function getGroupOfUser(String $username): String {
        global $DB;
        $user = $this->getRecord($username);
        $groupName = $DB->get_record('groups_members', array('userid' => $user->id));
        return $groupName;
    }


    /**
     * Delete a user
     * @param $username
     */
    public function deleteUser(String $username): void{
        global $DB;
        $groupsDB = new GroupsDB();
        $group = $groupsDB->getGroupByUser($username);
        if ($group != false) {
            $groupsDB->deleteMember($group["name"], $username);
        }
        $this->deleteRole($username);
        $DB->delete_records('user', array('username' => $username));
    }

    /**
     * Update a user
     * @param $username
     */
    public function updateUser(String $username, String $firstName, String $lastName, bool $password, int $role) : array{
        global $DB;
        if ($password == false) {
            $user = $this->getRecord($username);
            $user->firstname = $firstName;
            $user->lastname = $lastName;
            $DB->update_record('user', $user);

            $this->deleteRole($username);
            role_assign($role, $user->id, context_system::instance());
            return array($username, $lastName, $firstName, $role);
        } else {
            $groupsDB = new GroupsDB();
            $group = $groupsDB->getGroupByUser($username);
            $this->deleteUser($username);
            $user =  $this->addUser($firstName, $lastName, $role, $group["name"]);
            return array($user[2], $lastName, $firstName, $user[0], $user[1]);
        }
    }


}
?>
