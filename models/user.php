<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
class User {

    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $registrationDate;

    //constructeur
    public function __construct(int $id, string $firstName, string $lastName, string $email, string $password, string $registrationDate){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->registrationDate = $registrationDate;
    }

    //getter
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string{
        return $this->firstName;
    }

    public function getemail(): string{
        return $this->email;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getRegistrationDate(): string{
        return $this-> registrationDate;
    }

    public function getLastName(): string{
        return $this->lastName;
    }

    //setter

    public function setFirstName(): string{
        return $this->firstName;
    }

    public function setemail(string $email): void{
        $this->email = $email;
    }

    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function setRegistrationDate(string $registrationDate): void{
        $this->registrationDate= $registrationDate;
    }

    public function setLastName(string $lastName): void{
        $this->lastName = $lastName;
    }

}
?>