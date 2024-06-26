CREATE TABLE User(
    UserID INTEGER PRIMARY KEY AUTOINCREMENT,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    Password VARCHAR(100),
    RegistrationDate DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Ressource (
    RessourceID INTEGER PRIMARY KEY AUTOINCREMENT,
    RessourceName VARCHAR(50),
    RessourceType VARCHAR(10),
    RessourcePath VARCHAR(1000),
    RessourceUpdate DATE,
    ResourceFirstUploadDate DATE,
    RessourceAuthorID INT,
    FOREIGN KEY (RessourceAuthorID) REFERENCES User(UserID)
);
CREATE TABLE Messages(
    MessageID INTEGER PRIMARY KEY AUTOINCREMENT,
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