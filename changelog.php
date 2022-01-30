<?php
session_start();
require_once("shared/inc/config.inc.php");
require_once("shared/inc/functions.inc.php");

include("templates/header.inc.php")
?>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 01, 2021</strong></p>
  <p>Application Version 2.12.1</p>
  <ul>
    <li>Admin can now Delete single 10x Abo</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>March 19, 2021</strong></p>
  <p>Application Version 2.12.0</p>
  <ul>
    <li>Added Mailto: in Admin UI</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>February 06, 2021</strong></p>
  <p>Application Version 2.11.0</p>
  <ul>
    <li>Added Member Counter in Admins UI</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 30, 2021</strong></p>
  <p>Application Version 2.10.3</p>
  <ul>
    <li>Hide results in Users UI Ranking</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 30, 2021</strong></p>
  <p>Application Version 2.10.2</p>
  <ul>
    <li>Small text changes in users UI</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 28, 2021</strong></p>
  <p>Application Version 2.10.0</p>
  <ul>
    <li>Bugfix problem that video shows after new Challenge is added in users area</li>
    <li>When no Data is in weekly Ranking hide Leaderboard</li>
    <li>Added new Page for Total Rankings, get all Data out of DB</li>
    <li>Changed both table, total ranking and weekly ranking to better format</li>
    <li>added custom sort function in total Ranking</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 28, 2021</strong></p>
  <p>Application Version 2.9.1</p>
  <ul>
    <li>Added Logo to admin Area</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 28, 2021</strong></p>
  <p>Application Version 2.9.0</p>
  <ul>
    <li>New Function to save weekly Ranking to new DB</li>
    <li>Created Array and encode it with json_encode, every time Admin deletes Challeng<br>
      Results are saved to new DB</li>
    <li>Adde nl2br() to info in Admins Challenges Results, for better visibility</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 28, 2021</strong></p>
  <p>Application Version 2.8.1</p>
  <ul>
    <li>Fixed sorting from Array in rankings list (PHP)</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 28, 2021</strong></p>
  <p>Application Version 2.8.0</p>
  <ul>
    <li>Total Ranking created out of Array men and women</li>
    <li>Done with complete logic creating Total Ranking</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 27, 2021</strong></p>
  <p>Application Version 2.7.0</p>
  <ul>
    <li>Slightly changed view in Admins Challenges-Result Area</li>
    <li>New Function for overall Result in Challenge start prototyping</li>
    <li>Added for loops in Javascript file to extract every user in Ordered List</li>
    <li>Getting every User and save his Rankin in temporary variable in index.js</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 26, 2021</strong></p>
  <p>Application Version 2.6.34</p>
  <ul>
    <li>Small changes to text Failures</li>
    <li>Added function in min/sek, when string of sec is exactly single number, than add 0 as String</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 26, 2021</strong></p>
  <p>Application Version 2.6.33</p>
  <ul>
    <li>Result can now be in m:s</li>
    <li>Doing some math to get this Value in Decimal and save to DB</li>
    <li>In Rankings reverse the Value to m:s</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 26, 2021</strong></p>
  <p>Application Version 2.6.32</p>
  <ul>
    <li>youtube Video Link in Challenges added</li>
    <li>Footer changed, copyright now under name</li>
    <li>Video only shows if not NULL in users Challenges</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 25, 2021</strong></p>
  <p>Application Version 2.6.31</p>
  <ul>
    <li>Fixed Sorting in leaderboard, changes result from string to int</li>
    <li>Colorize Leaderboadr with Gold, Silver and Bronze</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 25, 2021</strong></p>
  <p>Application Version 2.6.3</p>
  <ul>
    <li>Fixed Problem when a User set new Time in Challenge</li>
    <li>Array challenges now is overwrited when user puts new Value</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 25, 2021</strong></p>
  <p>Application Version 2.6.2</p>
  <ul>
    <li>Leaderboard works now in User and Admin Area</li>
    <li>Leaderboard is sorted and seperated by women and men</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 24, 2021</strong></p>
  <p>Application Version 2.6.1</p>
  <ul>
    <li>Created Page Leaderboard for all Challenges</li>
    <li>Challenge array logic changed, users and their time are saved seperately</li>
    <li>Leaderboard shows now all the Results and get Names out of DB</li>
    <li>Logic for leaderboard not implemented for now</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 24, 2021</strong></p>
  <p>Application Version 2.6.0</p>
  <ul>
    <li>Created mysql command for new DB for challenges</li>
    <li>New Page in Admin Area for creating challenges</li>
    <li>Mysql command for creating new DB `challenges`</li>
    <li>New Page in Admin Area for challenges</li>
    <li>Logic for deleting challenges</li>
    <li>users see now all Challenges and are able to set their Results</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 23, 2021</strong></p>
  <p>Application Version 2.6.0</p>
  <ul>
    <li>New Users now have to set male or female while registering</li>
    <li>added Logic and new DB commands for register site</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 11, 2021</strong></p>
  <p>Application Version 2.5.2</p>
  <ul>
    <li>Registration Deadline added for Trainings, ends at 14:00</li>
    <li>Changed view when user has no Abo or Training reaches Max members<br>
      new comes and info Box that can be closed, not a button</li>
    <li></li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 10, 2021</strong></p>
  <p>Application Version 2.5.1</p>
  <ul>
    <li>Integrated Search Form in Abo Area</li>
    <li>Created search Logic for filtering Database</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 08, 2021</strong></p>
  <p>Application Version 2.5.0_1</p>
  <ul>
    <li>When User is removed from Training<br>
      failure fixed where he doesnt become 1 abo back (10x abo users only)</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 07, 2021</strong></p>
  <p>Application Version 2.5.0</p>
  <ul>
    <li>Reworked code for Storing Users that have checked in <br>
      User are now stored with ID number</li>
    <li>View Trainings in Admin Area changed for compatibility with users ID</li>
    <li>Add Button "remove user" in Admin Area->Trainings</li>
    <li>Added complete Logic for removing Users from Training</li>
    <li>When a user that has no Abo, means he has a 10x abo is removed from Training<br>
      then he becomes his single abo back</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 06, 2021</strong></p>
  <p>Application Version 2.4.8</p>
  <ul>
    <li>Admin can now Edit existing Trainings</li>
    <li>Slightly changed View of Abos in Admin Area</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 06, 2021</strong></p>
  <p>Application Version 2.4.7</p>
  <ul>
    <li>Changed automatic delete Interval for Trainings from 2 to 1 Days</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 05, 2021</strong></p>
  <p>Application Version 2.4.6</p>
  <ul>
    <li>Changed ordering from Trainings in Admin & User Area,<br>
      new sort by Date not ID to prevent wrong ordering when ID not matching Datetime</li>
    <li>Created Border for better visibility in Admins Abo Section</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 04, 2021</strong></p>
  <p>Application Version 2.4.5</p>
  <ul>
    <li>Order Trainings ascending, so the latest Training comes first</li>
    <li>Fixed Problem that Users cant Log in when Checked-In earlier Training in Column</li>
    <li>Added confirmation Box when Users CheckIn for Training</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 03, 2021</strong></p>
  <p>Application Version 2.4.3/ 2.4.4</p>
  <ul>
    <li>Changed Login Form, from Username to E-Mail</li>
    <li>Changed Welcome Page, Login Form comes first</li>
    <li>Menu Navigation internal Area more clear now</li>
    <li>Added Birthdate in Register Form and DB</li>
    <li>Birthdate can now be edited from User</li>
    <li>Birthdate added in Abo Data, Admin Area</li>
    <li>Fixed Problem with Password when Admin changes Name from User</li>
    <li>Admin can now reset Password</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>January 01, 2021</strong></p>
  <p>Application Version 2.4.2</p>
  <ul>
    <li>Small changes to Text failures</li>
    <li>Centering Welcome Page better when on bigger Screens</li>
    <li>Added Messages Page in Admin Area</li>
    <li>Create Connection to DB Messages</li>
    <li>Added delete Button for Message</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 30, 2020</strong></p>
  <p>Application Version 2.4.1</p>
  <ul>
    <li>Added sw.js File inside Root Directory</li>
    <li>Added app.js File in js Directory</li>
    <li>Linked app.js in Footer File, so loads on every Page</li>
    <li>Implemented complete Serviceworker Lifecycle</li>
    <li>Reached minimum requirements for installability</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 30, 2020</strong></p>
  <p>Application Version 2.4.0</p>
  <ul>
    <li>Changed Webmanifest to JSON File</li>
    <li>Changed Manifest include in Header File</li>
    <li>Added more Logo Sizes to manifest.json and "img" Folder</li>
    <li>Revised Function for approving If User has already Checked In, Training Area</li>
    <li>App Installation on Homescreen now Supports IOS</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 30, 2020</strong></p>
  <p>Application Version 2.3.9</p>
  <ul>
    <li>Added new Style and Content to Header File</li>
    <li>Register Button is now available under the Login Form</li>
    <li>Check if user has already checked-in and hide Button in Trainings Area</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 29, 2020</strong></p>
  <p>Application Version 2.3.8</p>
  <ul>
    <li>Changed Webmanifest, added Start URL</li>
    <li>Tested it on Localhost before Uploading</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 29, 2020</strong></p>
  <p>Application Version 2.3.7</p>
  <ul>
    <li>Added Web Manifest and linked it to header</li>
    <li>Added Icons 192px and 512px for Manifest</li>
    <li>Uploaded new Files with Manifest</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 29, 2020</strong></p>
  <p>Application Version 2.3.6</p>
  <ul>
    <li>Added Column 10x Abo in config.inc User DB</li>
    <li>Added function "decrease" 10x Abo if User checks in</li>
    <li>Order List `training` by Date in Users Internal Area</li>
    <li>Fixed Problem where User cant check In, even when Abo is deposited</li>
    <li>Create Path for Database on Server</li>
    <li>Added .htacess file in config Folders for Safety Reason</li>
    <li>Create password protection in Admin Area</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 28, 2020</strong></p>
  <p>Application Version 2.3.5</p>
  <ul>
    <li>Added Button and Logic, creating Abo with expiring Date</li>
    <li>Created Delete Button for 10x Abo</li>
    <li>Added Personal Abo Data in Personal Space</li>
    <li>Users can`t now check-in if no Abo is available</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 28, 2020</strong></p>
  <p>Application Version 2.3.4</p>
  <ul>
    <li>Changed Abo Form to Readonly</li>
    <li>Changed config.inc, Create new Column for 10x Abos</li>
    <li>Added Button and logic, create 10x Abo</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 28, 2020</strong></p>
  <p>Application Version 2.3.3</p>
  <ul>
    <li>Added Changelog</li>
    <li>Added Impressum</li>
    <li>Added Logic counter, Abo expiring Date</li>
    <li>Changed Location Header when updating User or Abo information</li>
    <li>Fixed Problem when User Abo is changed and Password gets wrong Value after saving</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 27, 2020</strong></p>
  <p>Application Version 2.3.2</p>
  <ul>
    <li>Add Time and Date to Admin Area</li>
    <li>Change Config.inc, added new column for Abo Expiring Date to User DB</li>
  </ul>
</div>

<div class="container mt-5">
  <hr class="my-3">
  <p><strong>December 26, 2020</strong></p>
  <p>Application Version 2.3.1</p>
  <ul>
    <li>User can now be edited in Admin Area</li>
  </ul>
</div>

<?php
include("templates/footer.inc.php")
?>