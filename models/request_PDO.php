<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
class request_PDO{

    //utilisation de php-sqlite3 (apt install php-sqlite3)
    private PDO $db;

    public function __construct(){
        $this->db = new PDO('sqlite:database.db');
    }

    private $questions=["Q1","Q2","Q3","Q4","Q5","Q6"];

    /**
     * Connect the user
     * @param $username : the email of the user
     * @param $password : the password of the user
     * @return bool : true if creds are goods else false
     */
    public function connect($username, $password){
        //requête de connexion
        $connect = $this->db->prepare('SELECT Password FROM User WHERE email=?');
        $connect->bindParam(1,$username);
        $connect->execute();
        $result = $connect->fetch();
        if(!$result){
            echo "User not found";
            return FALSE;
        }
        return password_verify($password, $result["Password"]);
    }

    /**
     * Add a user
     * @param $firstName : the first name of the user
     * @param $lastName : the last name of the user
     * @param $email : the email of the user
     * @param $password : the password of the user
     */
    public function addUser($firstName, $lastName, $email, $password){
        //check if user already exist
        $alReadyExist = $this->db->prepare('SELECT * FROM User WHERE email=?');
        $alReadyExist->bindParam(1,$email);
        $alReadyExist->execute();
        if($alReadyExist->fetch()){
            echo "User already exist";
            return;
        }

        //Add the user
        $hash=password_hash($password, PASSWORD_DEFAULT);
        $add = 'INSERT INTO User(FirstName,LastName,email,Password) VALUES (?,?,?,?)';
        $add = $this->db->prepare($add);
        $add->execute([$firstName,$lastName,$email,$hash]);
    }

    /**
     * Change the password of a user
     * @param $id : the id of the user
     * @param $password : the new password of the user
     */
    public function changePassword($email, $password){
        $hash=password_hash($password, PASSWORD_DEFAULT);
        $changePasswd = 'UPDATE User SET PASSWORD=? WHERE email=?';
        $changePasswd = $this->db->prepare($changePasswd);
        $changePasswd->execute([$hash,$email]);
    }

    public function response($id,$question,$reponses){

        $question = 'INSERT INTO Question(QuestionText,AttempID) VALUES (?,?)';
        $question = $this->db->prepare($question);
        $question->execute([$QuestionText,$id]);

        $dernierID=$db->prepare('SELECT COUNT(*) as count FROM Question');
        $dernierID->execute();
        $result=$dernierID->fetch();

        foreach ($responses as $key => $value) {
            $response = 'INSERT INTO Response(ResponseText,QuestionID) VALUES (?,?,?,?,?,?,?)';
            $response = $this->db->prepare($response);
            $response->execute([$ResponseText,$dernierID]); 
        }
    }

    public function attemps($AttemptScore,$VisitorIP,$VisitorAge,$VisitorRegion,$VisitorDiscipline,$VisitorIsClient,$ClientID){

        $attempt = 'INSERT INTO Attempt(AttemptScore,VisitorIP,VisitorAge,VisitorRegion,VisitorDiscipline,VisitorIsClient,ClientID) VALUES (?,?,?,?,?,?,?)';
        $attempt = $this->db->prepare($attempt);
        $attempt->execute([$AttemptScore,$VisitorIP,$VisitorAge,$VisitorRegion,$VisitorDiscipline,$VisitorIsClient,$ClientID]);
    }
}

?>