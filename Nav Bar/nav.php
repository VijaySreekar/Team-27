<!DOCTYPE html>
<html lang="en">
  <head> </head>
  <style>
    ul {
      list-style-type: none;
      overflow: hidden;
      margin: 0;
      padding: 0;
      background-color: #11100f;
    }
    li {
      float: left;
    }
    li a {
      display: block;
      color: #ffffff;
      text-align: center;
      padding: 10px 12px;
      text-decoration: none;
    }
    li a:hover {
      background-color: #2a6d92;
    }
  </style>
  <body>
    <div class="nav-bar">
      <ul>
        <li>
          <img src="Images\Treakers Logo.png" alt="treakers logo" width="45" />
        </li>
        <li><a href="/Home Page/index.html">Treakers</a></li>
        <li>
          <form action="/search.php">
            <input type="text" placeholder="Search" name="search" />
          </form>
        </li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="basket.php">Basket</a></li>
      
        <li><a href="profile.php">Profile</a></li>        
      </ul>
    </div>
  </body>
</html>
