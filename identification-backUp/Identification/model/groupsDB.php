<?php

require_once(dirname(__FILE__) . '/userDB.php');

class GroupsDB {

    public function addGroups(String $groupeName, String $desc = 'Pas de description') : int {
    
        // Créer les données nécessaires pour créer un nouveau cours.
        $data = new stdClass();
        $data->fullname = $groupeName;
        $data->shortname = $groupeName;
        $data->summary = $desc;
        $data->format = "topics";
        $data->category = 1; // L'ID de la catégorie du cours.
    
        // Créer le cours.
        $newcourse = create_course($data);
    
        // Créer le groupe en utilisant le cours nouvellement créé comme contexte.
        $group = new stdClass();
        $group->name = $groupeName;
        $group->description = $desc;
        $group->courseid = $newcourse->id;
        $idGroup = groups_create_group($group);
    
        return $idGroup;
    }
    public function createMember(String $groupId, String $firstName, String $lastName): array{
        global $DB;
        // Appeler la fonction addUser() pour récupérer l'ID de l'utilisateur.
        $userDB = new UserDB();
        $user = $userDB->addUser($firstName, $lastName);
        // Ajouter l'utilisateur au groupe.
        $userID = $userDB->getRecord($user[0]);

        $member = new stdClass();
        $member->groupid = $groupId;
        $member->component = "";
        $member-> itemid =  0;
        $member->timeadded = time();
        $member->userid = $userID->id;

        $DB->insert_record('groups_members', $member);

        return array($user[0], $user[1], $user[2]);
    }

    public function addMember(String $groupId, String $username){
        global $DB;
        // Appeler la fonction addUser() pour récupérer l'ID de l'utilisateur.
        $userDB = new UserDB();
        // Ajouter l'utilisateur au groupe.
        $userID = $userDB->getRecord($username);

        $member = new stdClass();
        $member->groupid = $groupId;
        $member->component = "";
        $member-> itemid =  0;
        $member->timeadded = time();
        $member->userid = $userID->id;

        $DB->insert_record('groups_members', $member);
    }

    public function deleteMember(String $groupeName, String $username): void{
        global $DB;
        $group = $DB->get_record('groups', array('name' => $groupeName));
        $user = $DB->get_record('user', array('username' => $username));
        groups_remove_member($group->id, $user->id);
    }

    
    public function deleteGroup(String $groupeName): void{
        global $DB;
        $members = $this->getMembers($groupeName);
        $DB->delete_records('course', array('fullname' => $groupeName, 'shortname' => $groupeName));
        
        foreach ($members as $member) {
            $this->deleteMember($groupeName, $member["username"]);
        }
        $DB->delete_records('groups', array('name' => $groupeName));
    }

    public function updateGroups(String $oldGroupName, String $groupeName, String $desc = 'Pas de description') : void{
        global $DB;
        $group = $this->getGroup($oldGroupName);
        $group->name = $groupeName;
        $group->description = $desc;
        groups_update_group($group);

    }

    public function getGroup(String $groupeName): mixed {
        global $DB;
        $group = $DB->get_record('groups', array('name' => $groupeName));
        return $group;
    }

    public function getMembers(String $groupeName) : array {
        global $DB;
        $group = $this->getGroup($groupeName);
        $group_members = $DB->get_records('groups_members', array('groupid' => $group->id));
        $members = array();
        $user = new UserDB();
        foreach ($group_members as $member) {
            $userInfo = $user->getUserById($member->userid);
            array_push($members, array(
                                        'lastname' => $userInfo->lastname, 
                                        'firstname' => $userInfo->firstname, 
                                        'username' => $userInfo->username));
        }
        return $members;
    }

    public function getGroupByUser(String $username) : mixed {
        global $DB;
        $groups = $this->getGroups();
        foreach($groups as $group){
            if($this->isMember($group["name"], $username)){
                return $group;
            }
        }
        return false;
    }

    public function isMember(String $groupeName, String $username) : bool {
        global $DB;
        $group = $this->getGroup($groupeName);
        $user = $DB->get_record('user', array('username' => $username));
        $group_members = $DB->get_records('groups_members', array('groupid' => $group->id));
        foreach ($group_members as $member) {
            if ($member->userid == $user->id) {
                return true;
            }
        }
        return false;
    }

    public function getGroups() : array {
        global $DB;
        $groups = $DB->get_records('groups');
        $groupsArray = array();
        foreach ($groups as $group) {
            array_push($groupsArray, array('name' => $group->name, 'description' => $group->description, 'members' => $this->getMembers($group->name)));
        }
        return $groupsArray;
    }
}


?>
