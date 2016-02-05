<?php

/**
 * View for listing all users.
 *
 */

 echo   "<h1>$title</h1>"
      . "<table><tr>"
      . "<th>Id</th>"
      . "<th>Användare</th>"
      . "<th>E-post</th>"
      . "<th>Namn</th>"
      . "<th>created</th>"
      . "<th>updated</th>"
      . "<th>deleted</th>"
      . "<th>active</th></tr>";

foreach ($users as $user) {
    echo "<tr><td>$user->id</td>"
      . "<td>$user->acronym</td>"
      . "<td>$user->email</td>"
      . "<td>$user->name</td>"
      . "<td>$user->created</td>"
      . "<td>$user->updated</td>"
      . "<td>$user->deleted</td>"
      . "<td>$user->active</td></tr>";
}

echo "</table>";
//<p><a href='$this->url->create('')'>Home</a></p>
