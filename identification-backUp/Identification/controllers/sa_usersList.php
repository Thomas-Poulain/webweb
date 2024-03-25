<?php
require(__ROOT__.'/controllers/Controller.php');
require(__ROOT__.'/static/assets/FPDF/fpdf.php');


class SaUserList extends Controller{

    /**
     *Filter the users
     */
    public function filterUsers() {
        $userDB = new UserDB();
        $users = $userDB->getUsers();

        // Filter the users
        foreach ($users as $key => $user) {
            if ($user->username == 'guest' || $user->username == 'moodleuser') {
                unset($users[$key]);
            } else {
                $user_roleID = $userDB->getUser_role($user->username);
                $user_role = '';
                if ($user_roleID == 4) {
                    $user_role = 'Élève';
                } else if ($user_roleID == 3) {
                    $user_role = 'Professeur';
                }
                $user->role = $user_role;
            }
        } 
        $columnsToKeep = ['username', 'firstname', 'lastname', 'role'];
        $newUsers = array_map(function($userDB) use ($columnsToKeep) {
            return array_intersect_key((array) $userDB, array_flip($columnsToKeep));
        }, $users);

        return $newUsers;
    }

    /**
     * Get the user list page
     * @param $request
     */
    public function get($request){
        if($_SESSION['role'] == 4){
            $this->render('sa_error',['message' => "Vous n'avez pas de permission d'entrer dans cette page"]);
        }else{
            $newUsers = $this->filterUsers();
            $this->render('sa_usersList',['users' => $newUsers]);
        }
    }

    /**
     * Delete the user
     * @param $username
     */
    public function delete($username) {
        $userDB = new UserDB();
        $userDB->deleteUser($username);

        $newUsers = $this->filterUsers();
        
        $this->render('sa_usersList',['users' => $newUsers]);
    }

    /**
     * Create a PDF file
     * @param $user
     */
    public function createPDF($user) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->Image(__ROOT__.'/static/img/logo_balabox.png',10,6,30);
        $pdf->SetFont('Arial', 'B', 18); // définit la police de caractères en gras avec une taille de 14
        $pdf->Cell(0, 45, iconv('UTF-8', 'windows-1252','Compte de ' . $user[3] . ' ' . $user[2]), 0, 1, 'C');


        $pdf->SetFillColor(255, 165, 0); // définit la couleur de fond à orange
        $pdf->SetTextColor(255, 255, 255); // définit la couleur de texte à blanc
        $pdf->SetFont('Arial', 'B', 14); // définit la police de caractères en gras avec une taille de 14

        
        
        $pdf->Ln();

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

        if ($user[0] == 4) {
            $role = 'Eleve';
        } else if ($user[0] == 3) {
            $role = 'Professeur Editeur';
        } else if ($user[0] == 2) {
            $role = 'Professeur';
        } else if ($user[0] == 1) {
            $role = 'Administrateur';
        }

        $pdf->SetTextColor(0, 0, 0); // définit la couleur de texte à noir
        $pdf->SetFont('Arial', '', 14); // définit la police de caractères sans gras
        $pdf->Cell($startX);
        $pdf->Cell($w[0],10,iconv('UTF-8', 'windows-1252',$role),'LR');
        $pdf->Cell($w[1],10,iconv('UTF-8', 'windows-1252',$user[1]),'LR'); // Nom
        $pdf->Cell($w[2],10,iconv('UTF-8', 'windows-1252',$user[2]),'LR'); // Prénom
        $pdf->Cell($w[3],10,iconv('UTF-8', 'windows-1252',$user[3]),'LR'); // Nom d'utilisateur
        $pdf->Cell($w[4],10,iconv('UTF-8', 'windows-1252',$user[4]),'LR'); // Mot de passe
        $pdf->Ln();


        $pdf->Cell($startX);
        $pdf->Cell(array_sum($w),0,'','T');

        $pdf_content = $pdf->Output('','S');
        $this->render('sa_download', ['pdf_content' => $pdf_content, 'filename' => 'Compte de ' . $user[3] . ' ' . $user[2] . '.pdf']);
    }
    
    /**
     * Update the user
     * @param $username
     * @param $newName
     * @param $newLastName
     * @param $newPassword
     * @param $newRole
     */
    public function update($username, $newName,$newLastName, $newPassword, $newRole) {
        $userDB = new UserDB();
        if ($newPassword == 'false') {
            $newPassword = false;
        } else {
            $newPassword = true;
        }
        if ($newRole == "Eleve") {
            $newRole = 4;
        } else if ($newRole == "Professeur Editeur") {
            $newRole = 2;
        } else if ($newRole == "Professeur") {
            $newRole = 3;
        }
        $user = $userDB->updateUser($username, $newName, $newLastName, $newPassword, $newRole);
        if ($user == false) {
            $this->render('sa_error',['message' => "Erreur de mise à jour de l'utilisateur"]);
        } else {
            if ($newPassword == true) {
                $this->createPDF($user);
            } else {
                $newUsers = $this->filterUsers();
                $this->render('sa_usersList',['users' => $newUsers]);
            }
            
        }
    
    }

    /**
     * Filter the users
     * @return array
     */
    public function post($request){
        if(isset($_POST['isDeleteUser'])){
            $this->delete($_POST['isDeleteUser']);
        } else if (isset($_POST['isUpdateUser'])) {
            $this->update($_POST['isUpdateUser'], $_POST['newName'], $_POST['newLastName'], $_POST['newPassword'], $_POST['newUserRole']);

        } else {
            $this->render('sa_error',['message' => 
                                      "Erreur de requête POST
                                      <br>isDeleteUser: ".$_POST['isDeleteUser']."<br>
                                        isUpdateUser: ".$_POST['isUpdateUser']."<br>
                                        newName: ".$_POST['newName']."<br>
                                        isUpdateUser: ".$_POST['isUpdateUser']."<br>
                                        newLastName: ".$_POST['newLastName']."<br>
                                        newPassword: ".$_POST['newPassword']."<br>
                                        newUserRole: ".$_POST['newUserRole']."<br>
                                        "
                                    ]);
        }
    }


}

?>
