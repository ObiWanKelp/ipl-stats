function loadTeams() {
  fetch("get_teams.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("teamList").innerHTML = data));
}

function loadPlayers() {
  fetch("get_players.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("playerList").innerHTML = data));
}

function loadBookings() {
  fetch("get_bookings.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("bookingList").innerHTML = data));
}

function loadVenues() {
  fetch("get_venues.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("venueList").innerHTML = data));
}

function loadMatches() {
  fetch("get_matches.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("matchList").innerHTML = data));
}

function loadTeamPoints() {
  fetch("get_team_points.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("pointsList").innerHTML = data));
}
