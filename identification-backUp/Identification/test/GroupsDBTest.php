<?php
use PHPUnit\Framework\TestCase;
require_once '/var/www/html/model/groupsDBTest.php';

class GroupsDBTest extends TestCase {

    public function setUp() : void {
        $this->groupsDB = new GroupsDB();
    }

    public function testAddGroups() : void {
        $groupName = "Groupe de test";
        $desc = "Ceci est un groupe de test";
        $groupID = $this->groupsDB->addGroups($groupName, $desc);

        $this->assertGreaterThan(0, $groupID);
        $this->assertIsNumeric($groupID);

        // Supprimer le groupe de test
        $this->groupsDB->deleteGroup($groupName);
    }

    public function testCreateMember() : void {
        $groupName = "Groupe de test";
        $desc = "Ceci est un groupe de test";
        $groupID = $this->groupsDB->addGroups($groupName, $desc);

        $firstName = "John";
        $lastName = "Doe";
        $result = $this->groupsDB->createMember($groupID, $firstName, $lastName);

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertContainsOnly('string', $result);

        // Supprimer le groupe de test
        $this->groupsDB->deleteGroup($groupName);
    }

    public function testAddMember() : void {
        $groupName = "Groupe de test";
        $desc = "Ceci est un groupe de test";
        $groupID = $this->groupsDB->addGroups($groupName, $desc);

        $firstName = "John";
        $lastName = "Doe";
        $user = new UserDB();
        $username = $user->addUser($firstName, $lastName)[0];

        $this->groupsDB->addMember($groupID, $username);
        $members = $this->groupsDB->getMembers($groupName);

        $this->assertIsArray($members);
        $this->assertCount(1, $members);
        $this->assertIsArray($members[0]);
        $this->assertArrayHasKey('lastname', $members[0]);
        $this->assertArrayHasKey('firstname', $members[0]);
        $this->assertArrayHasKey('username', $members[0]);
        $this->assertEquals($firstName, $members[0]['firstname']);
        $this->assertEquals($lastName, $members[0]['lastname']);
        $this->assertEquals($username, $members[0]['username']);

        // Supprimer le groupe de test
        $this->groupsDB->deleteGroup($groupName);
    }


    public function testAddGroups(): void {
        $groupName = "Groupe de test";
        $description = "Description du groupe de test";
        $groupID = $this->groupsDB->addGroups($groupName, $description);

        $this->assertNotNull($groupID);
    }

    public function testCreateMember(): void {
        $groupName = "Groupe de test";
        $firstName = "John";
        $lastName = "Doe";
        $member = $this->groupsDB->createMember($groupName, $firstName, $lastName);

        $this->assertNotNull($member);
    }

    public function testAddMember(): void {
        $groupName = "Groupe de test";
        $username = "johndoe";
        $this->groupsDB->addMember($groupName, $username);

        $this->assertTrue($this->groupsDB->isMember($groupName, $username));
    }

    public function testDeleteMember(): void {
        $groupName = "Groupe de test";
        $username = "johndoe";
        $this->groupsDB->deleteMember($groupName, $username);

        $this->assertFalse($this->groupsDB->isMember($groupName, $username));
    }

    public function testDeleteGroup(): void {
        $groupName = "Groupe de test";
        $this->groupsDB->deleteGroup($groupName);

        $this->assertNull($this->groupsDB->getGroup($groupName));
    }

    public function testUpdateGroups(): void {
        $oldGroupName = "Groupe de test";
        $newGroupName = "Nouveau groupe de test";
        $newDescription = "Nouvelle description du groupe de test";
        $this->groupsDB->updateGroups($oldGroupName, $newGroupName, $newDescription);

        $updatedGroup = $this->groupsDB->getGroup($newGroupName);
        $this->assertEquals($updatedGroup->name, $newGroupName);
        $this->assertEquals($updatedGroup->description, $newDescription);
    }

    public function testGetGroup(): void {
        $groupName = "Groupe de test";
        $group = $this->groupsDB->getGroup($groupName);

        $this->assertNotNull($group);
        $this->assertEquals($group->name, $groupName);
    }

    public function testGetMembers(): void {
        $groupName = "Groupe de test";
        $members = $this->groupsDB->getMembers($groupName);

        $this->assertNotEmpty($members);
        $this->assertInternalType('array', $members);
    }

    public function testGetGroupByUser(): void {
        $username = "johndoe";
        $group = $this->groupsDB->getGroupByUser($username);

        $this->assertNotNull($group);
        $this->assertEquals($group['name'], 'Nouveau groupe de test');
    }

    public function testIsMember(): void {
        $groupName = "Nouveau groupe de test";
        $username = "johndoe";

        $this->assertTrue($this->groupsDB->isMember($groupName, $username));
    }


    public function testGetGroups()
    {
        $groupsDB = new GroupsDB();
        
        $groups = $groupsDB->getGroups();

        $this->assertIsArray($groups);
        $this->assertNotEmpty($groups);
        foreach ($groups as $group) {
            $this->assertArrayHasKey('name', $group);
            $this->assertArrayHasKey('description', $group);
            $this->assertArrayHasKey('members', $group);
            $this->assertIsArray($group['members']);
            $this->assertNotEmpty($group['members']);
            foreach ($group['members'] as $member) {
                $this->assertArrayHasKey('firstname', $member);
                $this->assertArrayHasKey('lastname', $member);
                $this->assertArrayHasKey('username', $member);
            }
        }
    }
}



?>