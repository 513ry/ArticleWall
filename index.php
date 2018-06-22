<?php
error_reporting(E_ALL);

require_once("../secure/blog_connect.php");

Acked-by: siery <siery@comic.com>

// create the querys
$post_query = $dbc->query ("SELECT * FROM post");
$post;
$post_2;
$cnt_query = $dbc->query ('SELECT COUNT(*) count FROM post');
$articles_amount;

if ($post_query && $cnt_query->num_rows) {
    // execute the query and put data into an array holding
    // array with fetched row
    $i = 0;
    while ($post = mysqli_fetch_array($post_query)) {
        $post_2[$i] = $post;
        $i ++;
    }

    $tmp = $cnt_query->fetch_object();
    $articles_amount = $tmp->count;
    
} else {
    echo "<style> body {padding: 10px !important;} main {display: none !important;} </style> 
<h3 style=\"color: grey; text-align: center !important;\"> Sorry, but the database connection is failing!
We are fixing this now. </h3>";
    mysqli_error($dbc);
}


// authorisate user

// show user interface

const FOUNDER = "Daniel Sierpiński";
const FOUNDED = "2018";
$year = date("Y");
// detete this `if` after new year 2019
if ($year == FOUNDED)
    $ownerSign = FOUNDER . " &copy " . FOUNDED;
else {
    $ownerSign = FOUNDER . " &copy " . FOUNDED . "-" . $year;
}

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Str84word - Algorithms, Programming, C++ </title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/mobile-res.css" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
  </head>
  
  <body onload="generateArticles()">
    <main>
      <!-- MAIN HEADER -->
      <header class="top-bar">
	<div class="main-nav-wrapper">
	  <div class="logo-wrapper">
	    <div onclick='link("index.php");' class="logo"></div>
	  </div>

	  <nav class="horizontal-nav-wrapper">
	    <ul>
	      <li class="nav-item">Blog</li>
	      <li class="nav-item">Arts</li>
	      <li class="nav-item">CV</li>
	      <li class="nav-item">Contact</li>
	    </ul>
	  </nav>

	  <nav class="settings logout">settings</nav>
	  
	  <div class="claer"></div>
	</div>
      </header>

      <div id="articles-feed" class="body-wrapper">
	<!-- ARTICLE DATA GENERATION -->
	<?php
          
          if ($articles_amount > 0) {
            for ($i = ($articles_amount - 1); $i >= 0; $i--) {
              echo "<div class=\"box\">";
              echo "<header class=\"title\">";
              echo "<h1>" . addslashes($post_2[$i][0]) . "</h1>";
              echo "</header>";
              echo "<article class=\"content\">";
              echo "<p>" . addslashes($post_2[$i][1]) . "</p>";
              echo "</article>";
              echo "</div>";
            }
          }
    ?>
	
      </div>

      <!-- FOOTER -->
	<footer>
	  <?php echo $ownerSign; ?>
	</footer>
      
    </main>


    <!-- JAVASCRIPT -->
    <script type="text/javascript">
      
      function link(l) {
	  window.location.replace(l);
      }
      
      function toggleNavPanel() {
	  let e = document.getElementById("toggle-nav-wrapper");
	  
	  if (e.style.display === "none") {
	      e.style.display = "block";
	  } else {
	      e.style.display = "none";
	  }
      }

    </script>
    
  </body>
</html>
