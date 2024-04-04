<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require_once(__ROOT__.'/controllers/Controller.php');

class ConnectController extends Controller{

    /**
     * Get method
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

        $response = ['B', 'B', 'B', ['A', 'B', 'C'], 'A', ['A','C']];

        for ($i = 1; $i <= count($request); $i++) {
            $reponseTMP = $response[$i-1];
            $requestTMP = $request['q'.$i];

            if (is_array($reponseTMP)) {
                for ($j = 0; $j < count($reponseTMP); $j++) {
                    if ($reponseTMP[$j] == $requestTMP[$j]) {
                        $score++;
                    }
                }
            } else{
                if ($reponseTMP == $requestTMP) {
                    $score++;
                }
            }
        }

        
        try{
            $this->render('/main',[]);
            
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
