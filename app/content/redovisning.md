Redovisning
====================================

Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------
Det här var, precis som det stod i kursmomentet, "lite tungt". Framförallt var
det en ganska stor mängd material att läsa igenom. Kursboken och de flesta
artiklarna var inga problem, men artiklarna om DI och själva Anax-MVC var verkligen
något att bita i. För Anax-MVC är det särskilt kopplingen mellan routes, kontroller,
vyer och innehåll som känns snårig, men jag tycker att jag fick en överblick och
tänker att detaljerna kommer allteftersom jag jobbar vidare med ramverket.

###Vilken utvecklingsmiljö använder du?
Linux Mint 17.2, Atom, Firefox, Chrome och git. Den här gången har jag behållit
samma miljö som i förra kursen (oophp). Var lite sugen på att byta tillbaka till
Ubuntu, men bestämde mig för att inte lägga tid på det nu.

###Är du bekant med ramverk sedan tidigare?
Nej, det är första gången jag jobbar med den här typen av ramverk.

###Är du sedan tidigare bekant med de lite mer avancerade begrepp som introduceras?
Vad gäller begreppen som har med objekt-orientering att göra kände jag till de
flesta sedan tidigare. Traits har jag bara hört läst om i oophp-kursen.

Även vad gäller programmeringsfilosofierna var de flesta bekanta. Separation of
Concerns och SOLID kände jag bara till ytligt.

Dependency Injection var nytt för mig. Jag har hört termen tidigare men var inte
insatt i det. Martin Fowlers artikel och Phalcons beskrivning av DI/service location
kändes också som tyngre bitar i kursmomentet. Jag läste igenom dem, men behöver
läsa på mer för att verkligen förstå alla resonemang mer grundligt.

###Din uppfattning om Anax, och speciellt Anax-MVC?
Anax-MVC var ett rejält kliv uppåt från Anax både vad gäller flexibilitet och
komplexitet. När vi läste om Anax i oophp kände jag att jag fick god överblick
redan från början, men MVC-varianten är så pass omfattande att jag säkert
behöver arbeta med den ett tag för att förstå hur de olika bitarna hänger samman.

Guiden "Anax som MVC-ramverk" och övningen "Bygg en me-sida med Anax-MVC" gav en
bra introduktion till ramverket och jag förstår grunderna i hur det fungerar
(tror jag).

Ramverket känns som en bra grund och som att det kan fungera bra som introduktion
till MVC-ramverk och säkert även för att bygga mer komplexa webb-platser med.

En sak som jag funderar lite över är att det blir ganska mycket PHP-kod som ska
köras för varje sidvisning. Ramverket skapar ett app-objekt som startas med en
dependency injector som i sin tur skapar ett tiotal objekt. Det känns som väldigt
mycket overhead för en sidvisning. Samtidigt kanske det inte innebär ett problem
i praktiken. För mindre siter har servern förmodligen resurser över ändå och för
större siter är det väl en nödvändig kostnad för att ha en site som är flexibel
och robust.

###Extra uppgifter
Jag har gjort en fork av Anax-MVC på GitHub och använder den för mitt arbete i
kursen.


Kmom02: Kontroller och Modeller
-------------------------------
Det här var ett givande kursmoment. Att själv lägga till funktionalitet
hjälper verkligen förståelsen för hur saker och ting hänger samman i ramverket.

Artiklarna om Phalcon med förklaringar av ramverkets struktur och komponenternas
roller var också bra. Förklaringarna var tydligare än för Anax-MVC och eftersom
ramverken är snarlika hjälper det förståelsen för Anax också.

Själva arbetet med uppgiften gick smidigt. Det var inga steg som jag fastnade på.
Svårigheterna var i första hand att förstå hur anropen via dispatchern fungerar
och hur de olika autoloader-funktionerna hittar sina klasser. Det la jag en del
tid på att reda ut för mig själv.

Jag valde att flytta in hanteringen av kommentarssidorna i `index.php` för
att fortsatt bara ha en frontcontroller. För kommentarsklasserna valde jag att
göra egna klasser (`MyCommentController` och `MyCommentsInSession`) som ligger i
appen och är underklasser till standard-versionerna i `Phpmvc\Comment`. På så sätt
kan jag hämta eventuella uppdateringar till `Phpmvc\Comment` utan att riskera att
skriva över mina ändringar.

Det var inte självklart om kommentarsfunktionerna skulle ligga i appen eller
ramverket men jag landade i att de inte platsar som standardkomponent
i ramverket och valde att lägga dem i appen istället.


###Hur känns det att jobba med Composer?
Det är ett smidigt sätt att hantera beroenden och externa paket, i synnerhet
för större projekt som kan ha många beroenden och beroenden i flera led.

###Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?
Jag har inte lagt särskilt mycket tid på att titta runt bland paketen, men det är
en god idé att återanvända befintliga lösningar framför att implementera allt från grunden.

Det blir också vanligare och mer accepterat (även inom företag) att man bygger lösningar genom att använda externa komponenter och att programmering mer handlar om att få
komponenter att fungera tillsammans än att bygga hela egna lösningar. 

###Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?
Jag tror jag har förstått det. När jag hade implementerat min lösning förstod
jag inte varför det faktiskt fungerade i alla flöden så jag satte mig med
papper och penna och gick igenom de flöden jag var osäker på. Läste även om delar
av artiklarna om Anax-MVC från Kmom01 och Kmom02 och förstod sammanhangen bättre nu.

###Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?
Nej, jag såg inte några direkta svagheter men har gjort en egen klass för att
bygga på med hantering av separata kommentarsflöden samt redigering & radering
av enskilda kommentarer.


Kmom03: Bygg ett eget tema
--------------------------

Kmom04: Databasdrivna modeller
------------------------------

Kmom05: Bygg ut ramverket
-------------------------

Kmom06: Verktyg och CI
----------------------

Kmom07/10: Projekt och examination
----------------------------------
