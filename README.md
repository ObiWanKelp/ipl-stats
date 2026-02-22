fgggg---ggggg
fffffggggghgggdfd
# ⭐ IPL Tournament Management System Main Readmeeeeeeeeeeeedddddd

### **DBMS Project • MySQL + PHP • Trigger, Cursor, Procedures, Full Frontend**gggggggggggggggwa

A complete IPL-style tournament management system built using **MySQL**, **SQL Procedures**, **Triggers**, **Functions**, **Cursors**, and a clean **PHP Frontend**.

This project fully meets DBMS lab requirements and is deployable on any local PHP server. Made as a minor project for DBMS.

---

# 📌 Features???yes

### 🏏 **Tournament Modules**

* Teamshhhhh
* Players
* Venues
* Matches
* Tickets
* Bookings
* Player Performance
* Team Points auto-updateeeee

---

# 🗄 Database (MySQL)

### **Tables Included**

| Table              | Purpose                  |
| ------------------ | ------------------------ |
| `Team`             | Stores IPL team info     |
| `Player`           | Player info per team     |
| `Venue`            | Stadium & location       |
| `MatchTbl`         | Match schedule           |
| `PlayerMatchStats` | Per-match stats          |
| `Ticket`           | Pricing categories       |
| `Booking`          | Customer bookings        |
| `TeamPoints`       | Auto-updated via trigger |
| `PlayerPoints`     | Calculated via cursor    |

---

# ⚙️ SQL Components Implemented

### ✔ **8 Stored Procedures**

* AddTeam
* AddPlayer
* AddVenue
* ScheduleMatch
* RecordPlayerMatchStats
* BookTicket
* GetPlayerProfile
* RecalculatePlayerPoints *(Cursor)*

### ✔ **Cursor**

Used in `RecalculatePlayerPoints()` to loop through players and compute dynamic points.

### ✔ **Trigger**

`trg_UpdateTeamPoints` updates team wins/losses/points after match result is updated.

### ✔ **Function**

`CalcStrikeRate(runs, balls)` returns batting strike rate.

---

# 🧩 Project Structure

```
ipl-stats/
│
├── index.html
├── style.css
├── config.php
├── delete.php
│
├── add_team.php
├── add_player.php
├── add_match.php
├── add_venue.php
│
├── get_teams.php
├── get_players.php
├── get_venues.php
├── get_matches.php
├── get_bookings.php
├── get_team_points.php
│
└── mysql_project.sql   ← Full DB schema + data + procedures
```

---

# 🔧 Installation & Setup

## 1️⃣ Import the SQL

From macOS Terminal:

```bash
mysql -u root < mysql_project.sql
```

Or inside mysql shell:

```sql
SOURCE /path/to/mysql_project.sql;
```

---

## 2️⃣ Configure PHP Database Connection

Update **config.php**:

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "ipl_dbms");
?>
```

---

## 3️⃣ Run the PHP Development Server

```bash
php -S localhost:8000
```

Open in browser:

```
http://localhost:8000
```

---

# 🗑 Universal Delete System

Deletion is handled by a **single file**, `delete.php`.

Example:

```
delete.php?type=team&id=5
```

Supported delete types:

* team
* player
* venue
* match
* booking
* ticket

Each internally calls its stored procedure.

---

# 🧪 Sample Data

The SQL file includes sample:

* 🏏 5 IPL teams
* 👕 10+ players
* 🏟 venues
* 📅 matches
* 🎫 tickets
* 🧍 bookings
* 📊 stats

Everything loads automatically.

---

# 🎓 Viva-Ready Highlights

* FULL DBMS implementation
* Trigger
* Cursor
* Function
* 8 Procedures
* Fully working frontend
* Universal delete architecture
* Clean ER-friendly schema

Perfect for practical + viva.

---

# 🤝 Contributing

Pull requests welcome. Create an issue for suggestions.
Will add  aowrking website
BLEH BLEH BLEH
Damn today sucked 
---
