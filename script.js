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
// 1) Upcoming matches
function loadUpcomingMatches() {
  fetch("get_upcoming_matches.php")
    .then((res) => res.text())
    .then(
      (data) => (document.getElementById("upcomingMatches").innerHTML = data)
    );
}

// 2) Match details
function loadMatchDetails() {
  fetch("get_match_details.php")
    .then((res) => res.text())
    .then((data) => (document.getElementById("matchDetails").innerHTML = data));
}

// 3) Total runs by each team
function loadTeamRunsByID() {
  const teamID = document.getElementById("teamRunsInput").value;

  if (teamID.trim() === "") {
    alert("Enter a valid Team ID");
    return;
  }

  fetch("get_team_runs_by_id.php?teamID=" + teamID)
    .then((res) => res.text())
    .then((data) => {
      document.getElementById("teamRunsResult").innerHTML = data;
    });
}
function loadPlayerStatsByID() {
  const id = document.getElementById("playerStatsInput").value;

  if (id.trim() === "") {
    alert("Enter a valid Player ID");
    return;
  }

  fetch("get_player_stats_by_id.php?playerID=" + id)
    .then((res) => res.text())
    .then((data) => {
      document.getElementById("playerStatsResult").innerHTML = data;
    });
}
