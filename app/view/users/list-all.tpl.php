<?php

/**
 * View for list multiple users.
 *
 */

 echo   "<h1>$title</h1>"
      . "<table><tr>"
      . "<th>Användare</th>"
      . "<th>Namn</th>"
      . "<th>E-post</th>"
      . "<th>Redigera</th>"
      . "<th>Kasta</th>"
      . "<th>Aktivera</th>"
      . "<th>Radera permanent</th></tr>";

foreach ($users as $user) {
    $trashLink = isset($user->deleted) ?
        "<a href='" . $urls['unDelete'] . $user->id . "'><i class='fa fa-undo'>" :
        "<a href='" . $urls['softDelete'] . $user->id . "'><i class='fa fa-trash'>"
        ;

    $activateLink = isset($user->active) ?
        "<a href='" . $urls['deactivate'] . $user->id . "'><i class='fa fa-pause-circle-o'>" :
        "<a href='" . $urls['activate'] .   $user->id . "'><i class='fa fa-play-circle-o'>"
        ;

    echo "<tr>"
      . "<td><a href='" . $urls['view'] . $user->id . "'><i class='fa fa-search'></i></a> $user->acronym</td>\n"
      . "<td>$user->name</td>"
      . "<td>$user->email</td>"
      . "<td><a href='" . $urls['edit'] . $user->id . "'><i class='fa fa-pencil'></i></a></td>"
      . "<td>$trashLink</td>"
      . "<td>$activateLink</td>"
      . "<td><a href='" . $urls['delete'] . $user->id . "'><i class='fa fa-ban'></a></td>";
}

echo "</table>";
