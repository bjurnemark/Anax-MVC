<?php

echo "<h1>Visa användare</h1>";

echo "<p><span class='label'>Id: </span><span class='data'>$user->id</span>";
echo "<p><span class='label'>Användare: </span><span class='data'>$user->acronym</span>";
echo "<p><span class='label'>Epost: </span><span class='data'>$user->email</span>";
echo "<p><span class='label'>Namn: </span><span class='data'>$user->name</span>";
echo "<p><span class='label'>Skapad: </span><span class='data'>$user->created</span>";
echo "<p><span class='label'>Ändrad: </span><span class='data'>$user->updated</span>";
echo "<p><span class='label'>Raderad: </span><span class='data'>$user->deleted</span>";
echo "<p><span class='label'>Aktiverad: </span><span class='data'>$user->active</span>";
