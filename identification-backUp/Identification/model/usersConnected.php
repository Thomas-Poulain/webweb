<?php

class UsersConnected{
    
    private $logFile = __ROOT__."/logs.csv";

    /**
     * Create a new connection in the log
     * @param username the username of user
     */
    public function newConnection($username, $role, $id): void{
        $this->checkAlreadyConnect($id);
        $fileHandle = fopen($this->logFile, "a+");
        $logEntry = array(
            $username,
            $role,
            $id
        );
        fputcsv($fileHandle, $logEntry);
        fclose($fileHandle);
    }

    /**
     * Check if the user is already connected
     * @param username the username of user
     * @return bool true if the user is already connected, false otherwise
     */
    public function checkAlreadyConnect($id) {
        $tempFile = tempnam(sys_get_temp_dir(), 'temp_log');
        $fileHandle = fopen($this->logFile, "r");
        $tempHandle = fopen($tempFile, "w");
        while (!feof($fileHandle)) {
            $data = fgetcsv($fileHandle);
            if($data == false){
                break;
            }
            if ($data[2] == $id) {
                continue; // Skip the line with the same id
            }
            fputcsv($tempHandle, $data);
        }
        fclose($fileHandle);
        fclose($tempHandle);
        unlink($this->logFile);
        rename($tempFile, $this->logFile);
    }

    /**
     * Get the list of users connected
     * @return the list of users connected
     */
    public function getUserConnected(){
        $list = array();
        $fileHandle = fopen($this->logFile, "r");
        while (!feof($fileHandle)) {
            $data = fgetcsv($fileHandle);
            if($data == false){
                break;
            }
            $logEntry = array(
                'username' => $data[0],
                'role' => $data[1]
            );
            $list[] = $logEntry;
        }
        fclose($fileHandle);
        return $list;
    }

    /**
     * Get the user by session id
     * @param session_id the session id
     * @return the user informations
     */
    public function getUserBySessionId($session_id) {
        $fileHandle = fopen($this->logFile, "r");
        while (!feof($fileHandle)) {
            $data = fgetcsv($fileHandle);
            if($data == false){
                break;
            }
            if ($data[2] == $session_id) {
                $userdb = new UserDB();
                $user = $userdb->getRecord($data[0]);
                $logEntry = array(
                    'username' => $data[0],
                    'role' => $data[1],
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname
                );
                fclose($fileHandle);
                return $logEntry;
            }
        }
        fclose($fileHandle);
        return False;
    }
}
?>