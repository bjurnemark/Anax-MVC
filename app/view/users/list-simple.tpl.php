<?php

/**
 * View for list multiple users.
 *
 */

 echo   "<h1>$title</h1>"
      . "<table><tr>"
      . "<th>Användare</th>"
      . "<th>Namn</th>"
      . "<th>E-post</th></tr>\n";

foreach ($users as $user) {
    echo "<tr>"
      . "<td>$user->acronym</td>"
      . "<td>$user->name</td>"
      . "<td>$user->email</td></tr>\n";
}

echo "</table>";
