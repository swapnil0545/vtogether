
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout2_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout2_text.css" />
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico" />
  <title>Meet Up</title>
</head>

<body>
  <!-- Main Page Container -->
  <div class="page-container">

    <!-- A. HEADER -->      
    <div class="header">
            
      <!-- A.1 HEADER MIDDLE -->
      <div class="header-middle">    
   
        <!-- Sitelogo and sitename -->
        <a class="sitelogo" href="#" title="Go to Start page"></a>
        <div class="sitename">
           <h1><a href="index.php" title="Go to Start page">Meet Up<span style="font-weight:normal;font-size:50%;">&nbsp;version-1</span></a></h1>
          <h2>Connect with your friends</h2>
        </div>

        <!-- Navigation Level 1 del-->
        <div class="nav1">
          <ul>
            <li><a href="index.php" title="Go to Start page">Home</a></li>
            <li><a href="aboutus.php" title="Get to know who we are">About</a></li>
            <li><a href="contactus.php" title="Get in touch with us">Contact</a></li>																		
            <li><a href="faq.php" title="Get an overview of website">Faq</a></li>
          </ul>
        </div>              
      </div>
      
      <!-- A.2 HEADER BREADCRUMBS -->
      <!-- Breadcrumbs -->
      <div class="header-breadcrumbs">
      <?php if($logged[id]){?>
        <!-- Search form -->                  
        <div class="searchform">
          <form action="search.php" method="post">
            <fieldset>
              <input type="text" name="search" class="field" title="Search Users" />
              <input type="submit" name="button" class="button" value="GO!" title="Search Users"/>
            </fieldset>
          </form>
        </div>
		<? }?>
      </div>
    </div>
    <!-- B. MAIN -->
    <div class="main">
