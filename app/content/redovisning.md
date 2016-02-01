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
Det var intressant att läsa om de olika design-principerna och tankarna bakom vertikala
och horisontella rutnät. Det gav mycket att se hur stor betydelse "alignment"
har för hur man uppfattar en sida och få lite inblick i hur man kan tänka kring
layout av en site.

När jag arbetade igenom övningen blev jag lite överraskad över att man kunde
importera `variables.less` efter `grid.less` trots att variablerna används i
`grid.less`. (Själva mix-ins anropas i och för sig inte förrän i den efterföljande
filen `structure.less`).

Ett problem jag har är att style-sheet inte hinner skapas första gången man
laddar sidan efter att ha gjort någon förändring i less-filerna. Tittar man på
devtools/network står det att `style.php` är 0 kb, men `style.css` blir
uppdaterad/skapad i filsystemet. När man gör refresh på sidan laddas allt som det ska.

Problemet verkar vara kopplat till `typography.less`. Kommenterar jag bort importen
av den fungerar styling första gången jag laddar sidan. Jag misstänker att
genereringen av `style.css` helt enkelt tar för lång tid. För en publicerad
webbsida hade det inte varit något problem eftersom det då finns en `style.css` som
är aktuell och kan returneras direkt. På en publik site hade man väl även pekat
om referensen till css-filen direkt istället för att köra `style.php` vid varje anrop.

Jag hade även ett litet problem med att hämta Font-Awesome enligt exemplet, men
det var enkelt löst genom att ändra versionsnumret till senaste versionen.

När jag gjort min egen style (som bygger vidare på övningen) får jag inte
rubrikerna att lägga sig "på linjerna" i det horisontella rutnätet. Tittar jag
på radhöjder och marginaler i devtools/boxmodell ser allt rätt ut (dvs det är
jämna multipler av det "magiska talet") men rubrikerna hamnar ändå inte rätt.
Den efterföljande texten i styckena hamnar däremot på linjerna, så jag grävde
inte ner mig i det. Försökte justera med `vertical-align` men fick inte det att
göra skillnad, så jag gick vidare med arbetet.

H3 fick fel radhöjd eftersom fontstorleken var lika med det magiska
talet, så jag ökade storleken på H3 något som en enkel workaround. "Rätt" lösning
vore väl att korrigera mixin för `.font-size` så att den även hanterar fallet att
fontstorleken är lika med det magiska talet.

Min site har en separat front-controller för temat. Jag hade lite problem med att
få rewrites i `.htaccess` rätt, men hittade ett par trådar i forumen
([här](http://dbwebb.se/forum/viewtopic.php?f=14&t=3315) och
[här](http://dbwebb.se/forum/viewtopic.php?f=40&t=2643&p=21701)) som tog upp
problemet och hjälpte mig på rätt spår.

### Extra
Jag lade upp temat som ett eget [repo](https://github.com/bjurnemark/Anax-MVC-grid-theme.git)
på GitHub. Det projektet innehåller även en "sample"-mapp med de filer som behövs
för att visa temat i Anax-MVC och en mycket enkel html-sida som använder temat
utan att använda Anax-MVC för att visa att temat fungerar även utan Anax.  

###Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?
De känns väldigt användbara. Bootstrap var mycket imponerande i hur det var
strukturerat och hur mycket funktionalitet det innehöll. Detta är första gången
jag jobbar med CSS-ramverk överhuvudtaget.

###Vad tycker du om LESS, lessphp och Semantic.gs?
LESS kändes som ett lyft mot standard CSS. Att kunna definiera värden
och återanvända dem så att man bara har ett ställe att ändra på underlättar.
Även mixins känns kraftfulla och det var bra att se de lite mer avancerade
exemplen (t ex `.font-size`) som sätter flera olika CSS-värden som är relaterade
till varandra.

Jag föredrar `lessphp` eller någon annan lösning som kompilerar CSS-filerna på
servern framför att låta webb-läsaren kompilera LESS-koden så att man har
kontroll på vilken CSS som genereras och kan testa exakt den. `style.php`
underlättade för att kunna utveckla utan att behöva kompilera less-filerna i
ett eget steg.

Även `Semantic.gs` var mycket användbart. Både för att få en snygg layout på
sidorna och för att skapa ett responsivt UI på ett enkelt sätt.

###Vad tycker du om gridbaserad layout, vertikalt och horisontellt?
Båda två känns som bra principer att följa om man inte har särskilda skäl att
göra något annorlunda. Grafisk design & "CSS-pyssel" är den delen av kurserna
som jag är minst intresserad av, men till och med jag såg vilken skillnad det
gjorde när element hade konsekventa storlekar och texten "hamnar rätt".

###Har du några kommentarer om Font Awesome, Bootstrap, Normalize?
Bootstrap tyckte jag som sagt var mycket imponerande och det är definitivt något
jag kommer att titta vidare på för att bygga webb-platser.

Normalize känns som en bra "default" att inkludera för att på ett enkelt sätt
få sina sidor mer enhetliga mellan olika webbläsare.

Font-Awesome var även det en bra resurs att känna till. Många symboler, enhetlig
stil mellan dem och flexibelt eftersom så mycket går att styra via CSS. (Dessutom är
jag inte alls kompis med GIMP, så kan jag slippa använda det gör jag gärna det).

###Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?
Som sagt, grafisk design är inte min starka sida, men jag tänkte att jag skulle
göra något som var ganska elegant men ändå enkelt. Jag höll mig till bara ett par
färger. För den responsiva delen vill jag undvika att element blir så små att
de blir oanvändbara. När man går mot mindre enheter valde jag att låta huvud-innehållet
och sido-menyn få full vidd. Vid ännu mindre enheter döljer jag en hel del element
för att inte användaren ska behöva scrolla igenom mängder av olika delar.

###Antog du utmaningen som extra uppgift?
Ja, jag har lagt upp temat som ett eget projekt på GitHub (se kommentarer ovan).
Som en del av det gjorde jag en separat, enkel html-sida som visar temat och de
olika regionerna. Där blev jag lite förvånad över hur få beroenden det ändå fanns
mot Anax, så det kändes bra.

Jag har försökt göra temat enkelt att styla genom att samla temats inställningar
i `site.less` och  `responsive.less`.

Kmom04: Databasdrivna modeller
------------------------------

Kmom05: Bygg ut ramverket
-------------------------

Kmom06: Verktyg och CI
----------------------

Kmom07/10: Projekt och examination
----------------------------------
