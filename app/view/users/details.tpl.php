<?php

echo "<h1>Visa användare</h1>";

echo "<p><div class='label'>Id: </div><div class='data'>$user->id</div>";
echo "<p><div class='label'>Användare: </div><div class='data'>$user->acronym</div>";
echo "<p><div class='label'>Epost: </div><div class='data'>$user->email</div>";
echo "<p><div class='label'>Namn: </div><div class='data'>$user->name</div>";
echo "<p><div class='label'>Skapad: </div><div class='data'>$user->created</div>";
echo "<p><div class='label'>Ändrad: </div><div class='data'>$user->updated</div>";
echo "<p><div class='label'>Raderad: </div><div class='data'>$user->deleted</div>";
echo "<p><div class='label'>Aktiverad: </div><div class='data'>$user->active</div>";
