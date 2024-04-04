<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require_once(__ROOT__.'/controllers/Controller.php');

class QuizController extends Controller{

    /**
     * Get method
     * @param $request
     */
    public function get($request){
        $this->render('quiz',[]);
    }

    /**
     * Post method
     * @param $request
     */
    public function post($request){
        // Récupération de l'utilisateur
        $score = 0;
        $q1 = $request['q1'];
        $q2 = $request['q2'];
        $q3 = $request['q3'];
        $q4 = $request['q4'];
        $q5 = $request['q4'];
        $q6 = $request['q5'];

        $VisitorIP = $_SERVER['REMOTE_ADDR'];
        $VisitorAge = $request['age'];
        $VisitorRegion = $request['region'];
        $VisitorDiscipline = $request['discipline'];

        if(isset($_SESSION['username'])){
            $ClientID = $_SESSION['username'];
            $VisitorIsClient = True;
            $ClientID = $_SESSION['username'];
        }else{
            $VisitorIsClient = False;
            $ClientID = NULL;
        }

        // Réponses aux questions
        $response = ['B', 'B', 'B', ['A', 'B', 'C'], 'A', ['A','C']];

        // Récupération des réponses
        $request_PDO = new request_PDO();

        // Récupération du score
        $score = $this->getScore($request, $response);
        $attempsID = $request_PDO->attemps($score,$VisitorIP,$VisitorAge,$VisitorRegion,$VisitorDiscipline,$VisitorIsClient,$ClientID);

        for ($i = 1; $i <= count($request); $i++) {
            $reponseTMP = $response[$i-1];
            $requestTMP = $request['q'.$i];

            // Si la question est une question à choix multiple
            if (is_array($reponseTMP)) {
                $allGood = true;
                for ($j = 0; $j < count($reponseTMP); $j++) {
                    if ($reponseTMP[$j] != $requestTMP[$j]) {
                        $allGood = false;
                    }
                }
                if ($allGood) {
                    $score++;
                }
                response($attempsID,$requestTMP,$reponseTMP);
            // si la question est une question à choix unique
            } else{
                if ($reponseTMP == $requestTMP) {
                    $score++;
                }
                response($attempsID,$requestTMP,$reponseTMP);
            }
        }
        $this->render('quiz',[$score]);
    }

    /**
     * Get the score of the user
     * @param $request
     */
    public function getScore($request, $response){
        $score = 0;
        for ($i = 1; $i <= count($request); $i++) {
            $reponseTMP = $response[$i-1];
            $requestTMP = $request['q'.$i];

            // Si la question est une question à choix multiple
            if (is_array($reponseTMP)) {
                $allGood = true;
                for ($j = 0; $j < count($reponseTMP); $j++) {
                    if ($reponseTMP[$j] != $requestTMP[$j]) {
                        $allGood = false;
                    }
                }
                if ($allGood) {
                    $score++;
                }

            // si la question est une question à choix unique
            } else{
                if ($reponseTMP == $requestTMP) {
                    $score++;
                }
            }
        }
        return $score;
    }
}
?>
