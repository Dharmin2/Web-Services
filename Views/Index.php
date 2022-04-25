<head>
    <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="\css\styles.css" />
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/Main/index/">Nurzap</a>
    </div>
    <ul class="nav navbar-nav">
        <ul class="dropdown-menu">
        </ul>
    </ul>
    <div class="overlay-content">
    <form action="/Item/searchItem" method="POST">
        <input type="text" name="search">
        <button type="submit">Search</button>
    </form>
  </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/Cart/index"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>

<div class="dropdown">      
  <button class="dropbtn">Items</button>
  <div class="dropdown-content"> <!-- Dropdown list -->
<a href="/Views/index">View All items</a><br>
<a href="/Views/addItem">Sell an Item</a><br>
</div>
</div>
<div class="dropdown">
  <button class="dropbtn">Account</button>
    <div class="dropdown-content"> <!-- Dropdown list -->
    <a href="/Views/ChangePasswordController/"style="text-decoration: none;">Change password</a>

    <a href="/Views/logout"style="text-decoration: none;">Logout</a>
  </div>


    </div>
    </ul>
  </div>
</nav>
    <div>
        <center>
    </ul>
  </div>
</body>
</html>