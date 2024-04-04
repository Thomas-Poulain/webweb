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

    /**
     * Add a response to the database
     * @param $AttemptScore : the score of the attempt
     * @param $VisitorIP : the IP of the visitor
     * @param $VisitorAge : the age of the visitor
     * @param $VisitorRegion : the region of the visitor
     * @param $VisitorDiscipline : the discipline of the visitor
     * @param $VisitorIsClient : if the visitor is a client
     * @param $ClientID : the id of the client
     * @param $QuestionText : the text of the question
     * @param $QuestionType : the type of the question
     * @param $NbrTrueResponses : the number of true responses
     * @param $AttemptID : the id of the attempt
     * @param $ResponseText : the text of the response
     * @param $IsTrue : if the response is true
     * @param $QuestionID : the id of the question
     */
    public function response($AttemptScore,$VisitorIP,$VisitorAge,$VisitorRegion,$VisitorDiscipline,$VisitorIsClient,$ClientID,$QuestionText,$QuestionType,$NbrTrueResponses,$AttemptID,$ResponseText,$IsTrue,$QuestionID){
    
        $attempt = 'INSERT INTO Attempt(AttemptScore,VisitorIP,VisitorAge,VisitorRegion,VisitorDiscipline,VisitorIsClient,ClientID) VALUES (?,?,?,?,?,?,?)';
        $attempt = $this->db->prepare($attempt);
        $attempt->execute([$AttemptScore,$VisitorIP,$VisitorAge,$VisitorRegion,$VisitorDiscipline,$VisitorIsClient,$ClientID]);

        $question = 'INSERT INTO Question(QuestionText,QuestionType,NbrTrueResponses,AttempID) VALUES (?,?,?,?,?,?,?)';
        $question = $this->db->prepare($question);
        $question->execute([$QuestionText,$QuestionType,$NbrTrueResponses,$AttemptID]);

        $response = 'INSERT INTO Response(ResponseText,IsTrue,QuestionID) VALUES (?,?,?,?,?,?,?)';
        $response = $this->db->prepare($response);
        $response->execute([$ResponseText,$IsTrue,$QuestionID]);
    }
}

?>