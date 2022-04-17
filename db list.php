<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$servername = "192.168.0.10";
$username = "admin";
$password = "Password123@";
$db = "Ultimate";
$team = new Team();
/*
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$sql = "SELECT * FROM players;";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $team->addPlayer($row["name"], $row["surname"], $row["number"], $row["gender"]);
    }
} else {
    echo "0 results";
}

echo json_encode($team, JSON_UNESCAPED_UNICODE);
*/
$games = new Games();
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$sql = "SELECT id, tournament, date(timestamp), opponent, offence FROM games;";
$result = $conn->query($sql);

if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $games->addGame($row["id"], $row["tournament"], $row["date"], $row["opponent"], $row["offence"]);
    }
} else {
    echo "0 results";
}

echo json_encode($games, JSON_UNESCAPED_UNICODE);

class Player {
    public $name;
    public $surname;
    public $number;
    public $gender;

    public function __construct($name, $surname, $number, $gender) {
        $this->name = $name;
        $this->surname = $surname;
        $this->number = (int)$number;
        if($gender ==  1) {
            $this->gender = true;
        }
        else {
            $this->gender = false;
        }
    }
}

class Team {
    public $players = array();

    public function addPlayer($name, $surname, $number, $gender) {
        $newPlayer = new Player($name, $surname, $number, $gender);
        $this->players[] = $newPlayer;
    }
}

class Game {
    public $id;
    public $tournament;
    public $opponent;
    public $date;
    public $offence;

    public function __construct($id, $tournament, $date, $opponent, $offence) {
        $this->id = (int)$id;
        $this->tournament = $tournament;
        $this->opponent = $opponent;
        $this->date = $date;
        if($offence == 1) {
            $this->offence = true;
        }
        else {
            $this->offence = false;
        }


    }
}

class Games {
    public $games = array();

    public function addGame($id, $tournament, $date ,$opponent, $offence) {
        $newGame = new Game($id, $tournament, $date, $opponent, $offence);
        $this->games[] = $newGame;
    }
}

$conn->close();
?>