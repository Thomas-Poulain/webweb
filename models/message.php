<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
class Message{
    private int $id;
    private string $expeditorLogin;
    private string $expeditorFirstName;
    private string $expeditorLastName;
    private string $expeditorEmail;
    private string $submissionDate;
    private string $object;
    private string $message;
    private bool $isRead;
    private bool $isClient;
    private int $clientID;
    private int $userID; #Foreign key

    public function __construct(int $id, string $expeditorLogin, string $expeditorFirstName, string $expeditorLastName, string $expeditorEmail, string $submissionDate, string $object, string $message, bool $isRead, bool $isClient, int $clientID, int $userID){
        $this->id = $id;
        $this->expeditorLogin = $expeditorLogin;
        $this->expeditorFirstName = $expeditorFirstName;
        $this->expeditorLastName = $expeditorLastName;
        $this->expeditorEmail = $expeditorEmail;
        $this->submissionDate = $submissionDate;
        $this->object = $object;
        $this->message = $message;
        $this->isRead = $isRead;
        $this->isClient = $isClient;
        $this->clientID = $clientID;
        $this->userID = $userID;
    }

    //getter

    public function getId(): int{
        return $this->id;
    }

    public function getExpeditorLogin(): string{
        return $this->expeditorLogin;
    }

    public function getExpeditorFirstName(): string{
        return $this->expeditorFirstName;
    }

    public function getExpeditorLastName(): string{
        return $this->expeditorLastName;
    }

    public function getExpeditorEmail(): string{
        return $this->expeditorEmail;
    }

    public function getSubmissionDate(): string{
        return $this->submissionDate;
    }

    public function getObject(): string{
        return $this->object;
    }

    public function getMessage(): string{
        return $this->message;
    }

    public function getIsRead(): bool{
        return $this->isRead;
    }

    public function getIsClient(): bool{
        return $this->isClient;
    }

    public function getClientID(): int{
        return $this->clientID;
    }

    public function getUserID(): int{
        return $this->userID;
    }

    // setter

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function setExpeditorLogin(string $expeditorLogin): void{
        $this->expeditorLogin = $expeditorLogin;
    }

    public function setExpeditorFirstName(string $expeditorFirstName): void{
        $this->expeditorFirstName = $expeditorFirstName;
    }

    public function setExpeditorLastName(string $expeditorLastName): void{
        $this->expeditorLastName = $expeditorLastName;
    }

    public function setExpeditorEmail(string $expeditorEmail): void{
        $this->expeditorEmail = $expeditorEmail;
    }

    public function setSubmissionDate(string $submissionDate): void{
        $this->submissionDate = $submissionDate;
    }

    public function setObject(string $object): void{
        $this->object = $object;
    }

    public function setMessage(string $message): void{
        $this->message = $message;
    }

    public function setIsRead(bool $isRead): void{
        $this->isRead = $isRead;
    }

    public function setIsClient(bool $isClient): void{
        $this->isClient = $isClient;
    }

    public function setClientID(int $clientID): void{
        $this->clientID = $clientID;
    }

    public function setUserID(int $userID): void{
        $this->userID = $userID;
    
    }
}
?>