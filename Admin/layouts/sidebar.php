<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            padding: 20px 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
            position: fixed;
            left: 0;
            top: 0;
        }

        .menuitems {
            color: #4a5568;
            padding: 14px 24px;
            margin: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 500;
        }

        .menuitems:hover {
            background-color: #f7fafc;
            transform: translateX(8px);
            color: #667eea;
        }

        .menuitems.active {
            background-color: #667eea;
            color: white;
        }

        .menuitems:hover .emoji {
            transform: scale(1.1);
        }


        .emoji {
            transition: transform 0.2s ease;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="menuitems " id="index" onclick="chnagePage(this)">
            <span class="emoji">⚙️</span>
            Dashboard
        </div>
        <div class="menuitems" id="carmanagement" onclick="chnagePage(this)">
            <span class="emoji">🚗</span>
            Car Management
        </div>
        <div class="menuitems" id="users" onclick="chnagePage(this)">
            <span class="emoji">👤</span>
            Users
        </div>
        <div class="menuitems" id="bookings" onclick="chnagePage(this)">
            <span class="emoji">📦</span>
            Leads & Bookings
        </div>
        <div class="menuitems" id="dealers" onclick="chnagePage(this)">
            <span class="emoji">📍</span>
            Location & Dealers
        </div>
        <div class="menuitems" id="marketing" onclick="chnagePage(this)">
            <span class="emoji">📢</span>
            Marketing
        </div>
        <div class="menuitems" id="settings" onclick="chnagePage(this)">
            <span class="emoji">⚙️</span>
            System Settings
        </div>
        <div class="menuitems" id="logout" onclick="chnagePage(this)">
            <span class="emoji">⚙️</span>
            Logout
        </div>
    </div>
</body>
<script>
    var qs = window.location.search;
    var params = new URLSearchParams(qs);
    var id = params.get('id');
    document.getElementById(id).classList.add("active");

    function chnagePage(ele) {

        window.location.href = ele.id + ".php?id=" + ele.id;
    }
</script>

</html>