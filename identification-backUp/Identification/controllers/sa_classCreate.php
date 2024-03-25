<?php

require(__ROOT__.'/controllers/Controller.php');
require(__ROOT__.'/static/assets/FPDF/fpdf.php');

class SaClassCreateController extends Controller{

    /**
     * Get the main page
     * @param $request
     */
    public function get($request){
        if($_SESSION['role'] != 1){
            $this->render('sa_error',['message' => "Vous n'avez pas de permission d'entrer dans cette page"]);
        }else{
            $this->render('sa_classCreate',[]);
        }
    }

    /**
     * Create a class
     * @param $request
     */
    public function post($request){
        $file_name = '';
        $upload_dir = sys_get_temp_dir();
        

            // CONDITION : TANT QUE LE FICHIER N'EST PAS PRESENT DANS /static/uploads, ALORS ON ATTEND 5s AVANT DE REESSAYER LA LECTURE
            while(empty($file_name)) {

                    if(isset($_FILES['csvFile']) && is_uploaded_file($_FILES['csvFile']['tmp_name'])){
                        $file_name = $_FILES['csvFile']['name'];
                        $file_tmp = $_FILES['csvFile']['tmp_name'];
                        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                                                if($file_extension != 'csv'){
                                                    $this->render('sa_error',['message' => 'Seuls les fichiers CSV sont acceptés ici.']);
                                                } else {
                                                    $destination_file = $file_tmp;
                                                    try{
                                                        // Ouvrir le fichier CSV
                                                        $file = fopen($destination_file, "r");
                                                        // Initialiser un tableau pour stocker les informations
                                                        $data = array();
                                                        // Parcourir chaque ligne du fichier sauf la première (contenant les informations des colonnes)
                                                        $line_counter = 0;
                                                        while (($line = fgetcsv($file, 0, ";")) !== false) {
                                                            if ($line_counter != 0) {
                                                                $data[] = $line;

                                                            }
                                                            $line_counter++;
                                                        }
                                                        // Fermer et supprimer le fichier
                                                        fclose($file);

                                                        if (count($data[0]) != 2) {
                                                            $this->render('sa_error',['message' => 'Le fichier CSV ne contient pas le bon nombre de colonnes. Il doit y avoir 2 colonnes :  Nom, Prénom']);
                                                        } else {
                                                        // Créer l'objet UserDB pour entrer des données dans la bdd Moodle
                                                        $groupDB = new GroupsDB();
                                                        // A VERIFIER : Créer la classe/////////////////////////////////////////////////
                                                        $idGroup = $groupDB->addGroups($_REQUEST['newClassName'], $_REQUEST['newClassSummary']);
                                                        
                                                        
                                                        // Création du fichier PDF
                                                        $pdf = new FPDF();
                                                        
                                                        $pdf->AddPage();
                                                        $pdf->SetAutoPageBreak(true, 20); // Ajouter un saut de page automatiquement si le texte dépasse la hauteur de la page
                                                        
                                                        $pdf->SetFont('Arial', 'B', 18); // définit la police de caractères en gras avec une taille de 18
                                                        $pdf->Cell(0, 45, iconv('UTF-8', 'windows-1252','Classe de ' . $_REQUEST['newClassName']), 0, 1, 'C'); // Ajoute une cellule contenant le titre centré avec un espacement vertical de 15
                                                        $pdf->Ln(); // Ajoute un saut de ligne pour espacer le titre du reste du contenu


                                                        // Ajout du logo
                                                        $pdf->Image(__ROOT__.'/static/img/logo_balabox.png',10,6,30);
                                                        $pdf->SetFillColor(255, 165, 0); // définit la couleur de fond à orange
                                                        $pdf->SetTextColor(255, 255, 255); // définit la couleur de texte à blanc
                                                        $pdf->SetFont('Arial', 'B', 14); // définit la police de caractères en gras avec une taille de 14

                                                        // Ajout du header
                                                        $header = array('Rôle', 'Nom', 'Prénom', 'Nom d\'utilisateur', 'Mot de passe');
                                                        $w = array(30,25,25,45,35);

                                                        // Centrer le tableau
                                                        $pdf->SetY(45);
                                                        $startX = ($pdf->GetPageWidth() - array_sum($w))/2 - 10;
                                                        $pdf->Cell($startX); // Ajouter de l'espace à gauche pour centrer le tableau
                                                        for($i=0;$i<count($header);$i++)
                                                            $pdf->Cell($w[$i],7,iconv('UTF-8', 'windows-1252',$header[$i]),1,0,'C',true);
                                                        $pdf->Ln();


                                                        $user = new UserDB();


                                                        foreach ($data as $line) {
                                                            list($username, $password,$role) =  $groupDB->createMember($idGroup, $line[1], $line[0]);
                                                            $member = $user->getRecord($username);

                                                            if ($role == 4) {
                                                                $role = 'Eleve';
                                                            } else if ($role == 3) {
                                                                $role = 'Professeur Editeur';
                                                            } else if ($role == 2) {
                                                                $role = 'Professeur';
                                                            } else if ($role == 1) {
                                                                $role = 'Administrateur';
                                                            }

                                                            $pdf->SetTextColor(0, 0, 0); // définit la couleur de texte à noir
                                                            $pdf->SetFont('Arial', '', 14); // définit la police de caractères sans gras
                                                            $pdf->Cell($startX);
                                                            $pdf->Cell($w[0],10,iconv('UTF-8', 'windows-1252',$role),'LR');
                                                            $pdf->Cell($w[1],10,iconv('UTF-8', 'windows-1252',$member->lastname),'LR');
                                                            $pdf->Cell($w[2],10,iconv('UTF-8', 'windows-1252',$member->firstname),'LR');
                                                            $pdf->Cell($w[3],10,iconv('UTF-8', 'windows-1252',$username),'LR');
                                                            $pdf->Cell($w[4],10,iconv('UTF-8', 'windows-1252',$password),'LR');
                                                            $pdf->Ln();
                                                        }

                                                        $pdf->Cell($startX);
                                                        $pdf->Cell(array_sum($w),0,'','T');
                                                        
                                                        //donner le pdf à la prochaine vue pour le téléchargement
                                                        $pdf_content = $pdf->Output('Classe_' . $_REQUEST['newClassName'],'S');
                                                        $this->render('sa_download', ['pdf_content' => $pdf_content, 'filename' => 'Classe de ' . $_REQUEST['newClassName'] . '.pdf']);


                                                    }
                                                    }catch(Exception $e){
                                                        $this->render('sa_error',['message' => $e->getMessage()]);
                                                    }

                        }
                    } else{
                        sleep(5); // Attendre 5 secondes avant de vérifier à nouveau
                    }
                }

    }
}

?>            		
