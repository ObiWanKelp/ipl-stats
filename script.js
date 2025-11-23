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
