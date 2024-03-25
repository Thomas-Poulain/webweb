CREATE TABLE User(
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    Password VARCHAR(100) ,
    RegistrationDate DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Ressource (
    RessourceID INT AUTO_INCREMENT PRIMARY KEY,
    RessourceName VARCHAR(50),
    RessourceType VARCHAR(10),
    RessourcePath VARCHAR(1000),
    RessourceUpdate DATE,
    ResourceFirstUploadDate DATE,
    RessourceAuthorID INT,
    FOREIGN KEY (RessourceAuthorID) REFERENCES User(UserID)
);

CREATE TABLE Messages(
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    ExpeditorName VARCHAR(50),
    ExpeditorFirstName VARCHAR(50),
    ExpeditorLastName VARCHAR(50),
    ExpeditorMail VARCHAR(50),
    SubmissionDate DATE,
    Object VARCHAR(255),
    Message VARCHAR(1000),
    IsRead BOOLEAN,
    IsClient BOOLEAN,
    ClientID INT,
    FOREIGN KEY (ClientID) REFERENCES User(UserID)
);