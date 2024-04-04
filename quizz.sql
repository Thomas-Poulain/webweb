DROP TABLE Response;
DROP TABLE Question;
DROP TABLE Attempt;

CREATE TABLE Attempt (
    AttemptID INTEGER PRIMARY KEY AUTOINCREMENT,
    AttemptScore INT,
    VisitorIP VARCHAR(50) UNIQUE,
    VisitorAge INT,
    VisitorRegion VARCHAR(50),
    VisitorDiscipline VARCHAR(50),
    VisitorIsClient BOOLEAN,
    ClientID INT,
    FOREIGN KEY (ClientID) REFERENCES User(UserID)
);

CREATE TABLE Question(
    QuestionID INTEGER PRIMARY KEY AUTOINCREMENT,
    QuestionText VARCHAR(1000),
    AttemptID INT,
    FOREIGN KEY (AttemptID) REFERENCES Attempt(AttemptID)
);

CREATE TABLE Response (
    ResponseID INTEGER PRIMARY KEY AUTOINCREMENT,
    ResponseText VARCHAR(1000),
    QuestionID INT,
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID)
);