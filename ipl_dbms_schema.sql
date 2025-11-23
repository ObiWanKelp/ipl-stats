/* ===========================================================
   IPL TOURNAMENT MANAGEMENT SYSTEM – FULL SQL PROJECT
   DB + TABLES + FUNCTION + TRIGGER + 8 PROCEDURES
   =========================================================== */

CREATE DATABASE IF NOT EXISTS ipl_dbms;
USE ipl_dbms;

/* ========================
      TEAM TABLE
   ======================== */
CREATE TABLE Team (
  TeamID INT AUTO_INCREMENT PRIMARY KEY,
  TeamName VARCHAR(50) NOT NULL,
  City VARCHAR(50),
  WinningYears VARCHAR(100)
);

/* ========================
      PLAYER TABLE
   ======================== */
CREATE TABLE Player (
  PlayerID INT AUTO_INCREMENT PRIMARY KEY,
  PlayerName VARCHAR(50) NOT NULL,
  Role VARCHAR(20),
  TeamID INT,
  MatchesPlayed INT DEFAULT 0,
  Runs INT DEFAULT 0,
  Centuries INT DEFAULT 0,
  Wickets INT DEFAULT 0,
  BallsFaced INT DEFAULT 0,
  FOREIGN KEY (TeamID) REFERENCES Team(TeamID)
);

/* ========================
      VENUE TABLE
   ======================== */
CREATE TABLE Venue (
  VenueID INT AUTO_INCREMENT PRIMARY KEY,
  VenueName VARCHAR(50) NOT NULL,
  City VARCHAR(50),
  StateName VARCHAR(50),
  StadiumName VARCHAR(50),
  SeatingCapacity INT
);

/* ========================
      MATCH TABLE
   ======================== */
CREATE TABLE MatchTbl (
  MatchID INT AUTO_INCREMENT PRIMARY KEY,
  TeamAID INT,
  TeamBID INT,
  VenueID INT,
  MatchDateTime DATETIME,
  WinnerTeamID INT NULL,
  LoserTeamID INT NULL,
  FOREIGN KEY (TeamAID) REFERENCES Team(TeamID),
  FOREIGN KEY (TeamBID) REFERENCES Team(TeamID),
  FOREIGN KEY (VenueID) REFERENCES Venue(VenueID),
  FOREIGN KEY (WinnerTeamID) REFERENCES Team(TeamID),
  FOREIGN KEY (LoserTeamID) REFERENCES Team(TeamID)
);

/* ========================
 PLAYER MATCH STATS TABLE
   ======================== */
CREATE TABLE PlayerMatchStats (
  MatchID INT,
  PlayerID INT,
  Runs INT,
  Balls INT,
  Wickets INT,
  PRIMARY KEY (MatchID, PlayerID),
  FOREIGN KEY (MatchID) REFERENCES MatchTbl(MatchID),
  FOREIGN KEY (PlayerID) REFERENCES Player(PlayerID)
);

/* ========================
 PLAYER POINTS TABLE
   ======================== */
CREATE TABLE PlayerPoints (
  PlayerID INT PRIMARY KEY,
  Points INT DEFAULT 0,
  FOREIGN KEY (PlayerID) REFERENCES Player(PlayerID)
);

/* ========================
 TEAM POINTS TABLE
   ======================== */
CREATE TABLE TeamPoints (
  TeamID INT PRIMARY KEY,
  MatchesPlayed INT DEFAULT 0,
  Wins INT DEFAULT 0,
  Losses INT DEFAULT 0,
  Points INT DEFAULT 0,
  FOREIGN KEY (TeamID) REFERENCES Team(TeamID)
);

/* ========================
      TICKET TABLE
   ======================== */
CREATE TABLE Ticket (
  TicketID INT AUTO_INCREMENT PRIMARY KEY,
  MatchID INT,
  Category VARCHAR(20),
  Price DECIMAL(10,2),
  FOREIGN KEY (MatchID) REFERENCES MatchTbl(MatchID)
);

/* ========================
     BOOKING TABLE
   ======================== */
CREATE TABLE Booking (
  BookingID INT AUTO_INCREMENT PRIMARY KEY,
  CustomerName VARCHAR(50),
  Email VARCHAR(50),
  TicketID INT,
  BookingDate DATETIME,
  Status VARCHAR(20) DEFAULT 'BOOKED',
  FOREIGN KEY (TicketID) REFERENCES Ticket(TicketID)
);

/* ===========================================================
   FUNCTION – STRIKE RATE
   =========================================================== */
DELIMITER $$
CREATE FUNCTION CalcStrikeRate(p_runs INT, p_balls INT)
RETURNS DECIMAL(6,2)
DETERMINISTIC
BEGIN
  IF p_balls IS NULL OR p_balls = 0 THEN
    RETURN 0;
  END IF;
  RETURN (p_runs * 100.0) / p_balls;
END$$
DELIMITER ;

/* ===========================================================
   8 STORED PROCEDURES
   =========================================================== */

/* 1) Add Team */
DELIMITER $$
CREATE PROCEDURE AddTeam(
  IN p_name VARCHAR(50),
  IN p_city VARCHAR(50),
  IN p_years VARCHAR(100)
)
BEGIN
  INSERT INTO Team(TeamName, City, WinningYears)
  VALUES (p_name, p_city, p_years);

  INSERT INTO TeamPoints(TeamID, MatchesPlayed, Wins, Losses, Points)
  VALUES (LAST_INSERT_ID(), 0, 0, 0, 0);
END$$
DELIMITER ;

/* 2) Add Player */
DELIMITER $$
CREATE PROCEDURE AddPlayer(
  IN p_name VARCHAR(50),
  IN p_role VARCHAR(20),
  IN p_team INT
)
BEGIN
  INSERT INTO Player(PlayerName, Role, TeamID)
  VALUES (p_name, p_role, p_team);

  INSERT INTO PlayerPoints(PlayerID, Points)
  VALUES (LAST_INSERT_ID(), 0);
END$$
DELIMITER ;

/* 3) Add Venue */
DELIMITER $$
CREATE PROCEDURE AddVenue(
  IN p_venueName VARCHAR(50),
  IN p_city VARCHAR(50),
  IN p_state VARCHAR(50),
  IN p_stadium VARCHAR(50),
  IN p_capacity INT
)
BEGIN
  INSERT INTO Venue(VenueName, City, StateName, StadiumName, SeatingCapacity)
  VALUES (p_venueName, p_city, p_state, p_stadium, p_capacity);
END$$
DELIMITER ;

/* 4) Schedule Match */
DELIMITER $$
CREATE PROCEDURE ScheduleMatch(
  IN p_teamA INT,
  IN p_teamB INT,
  IN p_venue INT,
  IN p_datetime DATETIME
)
BEGIN
  INSERT INTO MatchTbl(TeamAID, TeamBID, VenueID, MatchDateTime)
  VALUES (p_teamA, p_teamB, p_venue, p_datetime);
END$$
DELIMITER ;

/* 5) Record Player Match Stats + update aggregates */
DELIMITER $$
CREATE PROCEDURE RecordPlayerMatchStats(
  IN p_match INT,
  IN p_player INT,
  IN p_runs INT,
  IN p_balls INT,
  IN p_wickets INT
)
BEGIN
  INSERT INTO PlayerMatchStats(MatchID, PlayerID, Runs, Balls, Wickets)
  VALUES (p_match, p_player, p_runs, p_balls, p_wickets)
  ON DUPLICATE KEY UPDATE
    Runs = Runs + p_runs,
    Balls = Balls + p_balls,
    Wickets = Wickets + p_wickets;

  UPDATE Player
  SET Runs = Runs + p_runs,
      BallsFaced = BallsFaced + p_balls,
      Wickets = Wickets + p_wickets,
      MatchesPlayed = MatchesPlayed + 1
  WHERE PlayerID = p_player;
END$$
DELIMITER ;

/* 6) Book Ticket */
DELIMITER $$
CREATE PROCEDURE BookTicket(
  IN p_customer VARCHAR(50),
  IN p_email VARCHAR(50),
  IN p_ticket INT
)
BEGIN
  START TRANSACTION;

  IF (SELECT COUNT(*) FROM Ticket WHERE TicketID = p_ticket) = 0 THEN
    ROLLBACK;
  ELSE
    INSERT INTO Booking(CustomerName, Email, TicketID, BookingDate, Status)
    VALUES (p_customer, p_email, p_ticket, NOW(), 'BOOKED');
    COMMIT;
  END IF;
END$$
DELIMITER ;

/* 7) Get Player Profile */
DELIMITER $$
CREATE PROCEDURE GetPlayerProfile(IN p_player INT)
BEGIN
  SELECT p.PlayerID,
         p.PlayerName,
         p.Role,
         p.MatchesPlayed,
         p.Runs,
         p.Centuries,
         p.Wickets,
         CalcStrikeRate(p.Runs, p.BallsFaced) AS StrikeRate,
         pp.Points
  FROM Player p
  LEFT JOIN PlayerPoints pp ON p.PlayerID = pp.PlayerID
  WHERE p.PlayerID = p_player;
END$$
DELIMITER ;

/* 8) Recalculate Player Points – CURSOR */
DELIMITER $$
CREATE PROCEDURE RecalculatePlayerPoints()
BEGIN
  DECLARE done INT DEFAULT 0;
  DECLARE v_playerID INT;
  DECLARE v_runs INT;
  DECLARE v_centuries INT;
  DECLARE v_wickets INT;
  DECLARE v_points INT;

  DECLARE cur CURSOR FOR
    SELECT PlayerID, Runs, Centuries, Wickets FROM Player;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

  OPEN cur;

  read_loop: LOOP
    FETCH cur INTO v_playerID, v_runs, v_centuries, v_wickets;
    IF done = 1 THEN
      LEAVE read_loop;
    END IF;

    SET v_points = (v_runs / 2) + (v_centuries * 50) + (v_wickets * 10);

    INSERT INTO PlayerPoints(PlayerID, Points)
    VALUES (v_playerID, v_points)
    ON DUPLICATE KEY UPDATE Points = v_points;
  END LOOP;

  CLOSE cur;
END$$
DELIMITER ;

/* ===========================================================
   TRIGGER – AUTO UPDATE TEAM POINTS WHEN MATCH RESULT SET
   =========================================================== */
DELIMITER $$
CREATE TRIGGER trg_UpdateTeamPoints
AFTER UPDATE ON MatchTbl
FOR EACH ROW
BEGIN
  IF NEW.WinnerTeamID IS NOT NULL THEN

    INSERT INTO TeamPoints(TeamID, MatchesPlayed, Wins, Losses, Points)
    VALUES (NEW.WinnerTeamID, 1, 1, 0, 2)
    ON DUPLICATE KEY UPDATE
      MatchesPlayed = MatchesPlayed + 1,
      Wins = Wins + 1,
      Points = Points + 2;

    IF NEW.LoserTeamID IS NOT NULL THEN
      INSERT INTO TeamPoints(TeamID, MatchesPlayed, Wins, Losses, Points)
      VALUES (NEW.LoserTeamID, 1, 0, 1, 0)
      ON DUPLICATE KEY UPDATE
        MatchesPlayed = MatchesPlayed + 1,
        Losses = Losses + 1;
    END IF;

  END IF;
END$$
DELIMITER ;

/* ===========================================================
   END OF FULL SQL PROJECT
   =========================================================== */
