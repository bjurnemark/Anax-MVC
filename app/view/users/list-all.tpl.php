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
      . "<th></th>"
      . "<th></th>"
      . "<th></th>"
      . "<th></th>"
      . "<th></th></tr>\n";

foreach ($users as $user) {
    // Make link do soft delete or undelete depending on current status
    $trashLink = isset($user->deleted) ?
        "<a href='" . $urls['unDelete'] . $user->id . "'><i class='fa fa-undo'></i></a>" :
        "<a href='" . $urls['softDelete'] . $user->id . "'><i class='fa fa-trash'></i></a>"
        ;

    // Make link do activate or deactivate depending on current status
    $activateLink = isset($user->active) ?
        "<a href='" . $urls['deactivate'] . $user->id . "'><i class='fa fa-pause-circle-o'></i></a>" :
        "<a href='" . $urls['activate'] .   $user->id . "'><i class='fa fa-play-circle-o'></i></a>"
        ;

    echo "<tr>"
      . "<td>$user->acronym</td>"
      . "<td>$user->name</td>"
      . "<td>$user->email</td>"
      . "<td class='action'><a href='" . $urls['view'] . $user->id . "'><i class='fa fa-search'></i></a></td>"
      . "<td class='action'><a href='" . $urls['edit'] . $user->id . "'><i class='fa fa-pencil'></i></a></td>"
      . "<td class='action'>$trashLink</td>"
      . "<td class='action'>$activateLink</td>"
      . "<td class='action'><a href='" . $urls['delete'] . $user->id . "'><i class='fa fa-ban'></i></a></td></tr>\n";
}

echo "</table>";
