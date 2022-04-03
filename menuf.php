<?php
echo <<<_MENU1
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- ref: https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_website&stacked=h -->

<!-- Navbar -->
<div class="w3-top">
<div class="w3-bar w3-theme-d2 w3-left-align">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    
    <a class="w3-bar-item w3-button w3-teal" href="http://mscidwd.bch.ed.ac.uk/s2160628/indexp.php"><i class="fa fa-home w3-margin-right"></i> CompLib </a>

    <a href="http://mscidwd.bch.ed.ac.uk/s2160628/phelp.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white"> About this website </a>

    <div class="w3-dropdown-hover w3-hide-small">
        <button class="w3-button" title="Notifications">Search<i class="fa fa-caret-down"></i></button>     
        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
            <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p1.php" class="w3-bar-item w3-button">Suppliers</a>
            <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p2.php" class="w3-bar-item w3-button">Compounds</a>
            <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p10b.php" class="w3-bar-item w3-button">Property</a>
        </div>
    </div>

    <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p3.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white"> Stats </a>

    <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p4.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white"> Correlations </a>

    <!-- <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p8a.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white"> Properties by Manufacturer </a> -->

    <a href="http://mscidwd.bch.ed.ac.uk/s2160628/p5.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white"> Exit </a>        
</div>
</div>

_MENU1;
