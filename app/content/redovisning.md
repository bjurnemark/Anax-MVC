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

**Vilken utvecklingsmiljö använder du?**<br>
Linux Mint 17.2, Atom, Firefox, Chrome och git. Den här gången har jag behållit
samma miljö som i förra kursen (oophp). Var lite sugen på att byta tillbaka till
Ubuntu, men bestämde mig för att inte lägga tid på det nu.

**Är du bekant med ramverk sedan tidigare?**<br>
Nej, det är första gången jag jobbar med den här typen av ramverk.

**Är du sedan tidigare bekant med de lite mer avancerade begrepp som introduceras?**<br>
Vad gäller begreppen som har med objekt-orientering att göra kände jag till de
flesta sedan tidigare. Traits har jag bara hört läst om i oophp-kursen.

Även vad gäller programmeringsfilosofierna var de flesta bekanta. Separation of
Concerns och SOLID kände jag bara till ytligt.

Dependency Injection var nytt för mig. Jag har hört termen tidigare men var inte
insatt i det. Martin Fowlers artikel och Phalcons beskrivning av DI/service location
kändes också som tyngre bitar i kursmomentet. Jag läste igenom dem, men behöver
läsa på mer för att verkligen förstå alla resonemang mer grundligt.

**Din uppfattning om Anax, och speciellt Anax-MVC?**<br>
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

**Extra uppgifter**<br>
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


**Hur känns det att jobba med Composer?**<br>
Det är ett smidigt sätt att hantera beroenden och externa paket, i synnerhet
för större projekt som kan ha många beroenden och beroenden i flera led.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**<br>
Jag har inte lagt särskilt mycket tid på att titta runt bland paketen, men det är
en god idé att återanvända befintliga lösningar framför att implementera allt från grunden.

Det blir också vanligare och mer accepterat (även inom företag) att man bygger lösningar genom att använda externa komponenter och att programmering mer handlar om att få
komponenter att fungera tillsammans än att bygga hela egna lösningar.

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**<br>
Jag tror jag har förstått det. När jag hade implementerat min lösning förstod
jag inte varför det faktiskt fungerade i alla flöden så jag satte mig med
papper och penna och gick igenom de flöden jag var osäker på. Läste även om delar
av artiklarna om Anax-MVC från Kmom01 och Kmom02 och förstod sammanhangen bättre nu.

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**<br>
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

**Extra**<br>
Jag lade upp temat som ett eget [repo](https://github.com/bjurnemark/Anax-MVC-grid-theme.git)
på GitHub. Det projektet innehåller även en "sample"-mapp med de filer som behövs
för att visa temat i Anax-MVC och en mycket enkel html-sida som använder temat
utan att använda Anax-MVC för att visa att temat fungerar även utan Anax.

**Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?**<br>
De känns väldigt användbara. Bootstrap var mycket imponerande i hur det var
strukturerat och hur mycket funktionalitet det innehöll. Detta är första gången
jag jobbar med CSS-ramverk överhuvudtaget.

**Vad tycker du om LESS, lessphp och Semantic.gs?**<br>
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

**Vad tycker du om gridbaserad layout, vertikalt och horisontellt?**<br>
Båda två känns som bra principer att följa om man inte har särskilda skäl att
göra något annorlunda. Grafisk design & "CSS-pyssel" är den delen av kurserna
som jag är minst intresserad av, men till och med jag såg vilken skillnad det
gjorde när element hade konsekventa storlekar och texten "hamnar rätt".

**Har du några kommentarer om Font Awesome, Bootstrap, Normalize?**<br>
Bootstrap tyckte jag som sagt var mycket imponerande och det är definitivt något
jag kommer att titta vidare på för att bygga webb-platser.

Normalize känns som en bra "default" att inkludera för att på ett enkelt sätt
få sina sidor mer enhetliga mellan olika webbläsare.

Font-Awesome var även det en bra resurs att känna till. Många symboler, enhetlig
stil mellan dem och flexibelt eftersom så mycket går att styra via CSS. (Dessutom är
jag inte alls kompis med GIMP, så kan jag slippa använda det gör jag gärna det).

**Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?**<br>
Som sagt, grafisk design är inte min starka sida, men jag tänkte att jag skulle
göra något som var ganska elegant men ändå enkelt. Jag höll mig till bara ett par
färger. För den responsiva delen vill jag undvika att element blir så små att
de blir oanvändbara. När man går mot mindre enheter valde jag att låta huvud-innehållet
och sido-menyn få full vidd. Vid ännu mindre enheter döljer jag en hel del element
för att inte användaren ska behöva scrolla igenom mängder av olika delar.

**Antog du utmaningen som extra uppgift?**<br>
Ja, jag har lagt upp temat som ett eget projekt på GitHub (se kommentarer ovan).
Som en del av det gjorde jag en separat, enkel html-sida som visar temat och de
olika regionerna. Där blev jag lite förvånad över hur få beroenden det ändå fanns
mot Anax, så det kändes bra.

Jag har försökt göra temat enkelt att styla genom att samla temats inställningar
i `site.less` och  `responsive.less`.

Kmom04: Databasdrivna modeller
------------------------------
Det här var ett intressant men väldigt omfattande och arbetskrävande kursmoment!

Ramverket Phalcon i sig och dess utvecklingsverktyg för att generera kod kan säkert
spara mycket tid om man bygger större webb-platser. Modell-klassen med dess grundfunktionalitet
för CRUD och för att hantera/söka i resultat känns kraftfull. Möjligheten att skapa
relationer mellan modeller och att spara data i flera modeller med ett gemensamt
save-kommando var snygg.

I kurslitteraturen blev det svårt att följa med i kapitel 13 utan att ha läst kapitel
12 eftersom resonemanget bygger vidare på exemplen från kapitel 12. Jag skummade
introduktionen till exemplet för att kunna följa med bättre. Det var intressant att
se hur författaren bygger upp strukturen och hur den möjliggör modell-lösningar
liknande den i Phalcon, men det var svårt att hänga med i alla detaljer.

För att förstå materialet djupare hade jag behövt gå tillbaka och arbete mer med
exempelkoden. Redan när jag läste det började jag dock ana att det här skulle ta
sin tid, så jag valde att gå vidare i arbetet och tills vidare nöja mig med att
veta att materialet finns där och är värt att repetera om jag ska jobba med den
här typen av lösningar.

Övningarna gav en bra grund och översikt av CForm och CDatabase och gav även en
bra kodbas att utgå från för uppgifterna. När jag arbetade med övningarna la jag
mina user-klasser i Anax-strukturen, men när det var dags för uppgiften valde jag
att flytta dem till app-strukturen eftersom de bör vara kopplade till appen
snarare än ramverket.

Medan jag höll på hittade jag ett mindre fel i `view/default/page.tpl.php` som
inte stänger sina anchor-element. Från början var ambitionen att rapportera det
som en pull-request, men det här momentet har redan tagit så mycket tid att det
får räcka med en kommentar här.

Jag tyckte det var svårt att veta vad som förväntades när man löste uppgifterna.
Själva grundkraven är tydliga, men hur "snyggt" måste det vara? Det blev en medelväg
för min del. Inte bara enklast möjliga, men inte heller särskilt mycket layout eller
styling.

**Vad tycker du om formulärhantering som visas i kursmomentet?**<br>
Verkligen användbar! Den kan säkert spara mycket tid framöver. De bitar jag tycker
är svårast att få grepp om är callback-funktionerna och vilken omgivning de kör
i/påverkar.

**Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?**<br>
Den kändes också mycket smidig och det var kul att se hur mycket kompaktare
kommentars-funktionaliteten blev när man kunde bygga vidare på basklassen för
datamodellen istället för att hantera allt "manuellt" i sessionen. Även om jag har
jobbat ganska mycket med SQL förr föredrar jag att använda den här databashanteringen
om det inte finns särskilda skäl att köra SQL direkt.

**Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?**<br>
Nej, jag följde övningen ganska strikt. När det var dags att lägga till kommentars-funktionaliteten
valde jag att också lägga till en funktion för `orderBy` men det var nog det enda.

**Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.**<br>
Jag höll det enkelt och la all kommentars-information i samma tabell, inklusive sidnyckeln
som anger vilken sida kommentaren hör till. Ur ett databasperspektiv borde den
egentligen ligga i en egen tabell och refereras med en foreign key, men det
kändes som för mycket arbete för en så enkel tabell. Mer generellt verkar
datamodelleringsklassen ge störst utdelning när man kan koppla modellen direkt
till en tabell.

Både för kommentarerna och användarna blev mina modeller helt tomma underklasser
till `CDatabaseModel`. Den hantering som behövs sköts i första hand i motsvarande
kontroller utom för formattering och presentation som hamnade i vyerna.

Kontrollern för user-klassen hade flera aktions som var ganska lika varandra
(`soft-delete, undelete, activate, deactivate`). Där flyttade jag ut en
del kod till gemensamma utility-funktioner.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**<br>
Nix, det fick vara. Det här var som sagt ett stort kursmoment och jag tror att
jag lagt ungefär 35 timmar på det, så det får räcka.



Kmom05: Bygg ut ramverket
-------------------------
Det här var ett roligt kursmoment. Skoj att själv få välja vad paketet skulle göra
och att få arbeta igenom alla stegen med att skapa, testa, dokumentera och publicera
ett paket.

En erfarenhet var hur mycket mer tid det tar att komma till en nivå där jag vill
publicera paketet jämfört med att ha något som känns "good enough" för eget bruk.

Ett par av argumenten för mikro-ramverk kändes bekanta från filosofin bakom Unix.

Mikro-ramverk:
 > Building small, single-purpose libraries.
 >
 > Using small things that work together to solve larger problems.

Unix ([ref](https://en.wikipedia.org/wiki/Unix_philosophy)):
 > ...at its heart is the idea that the power of a system comes more from
 > the relationships among programs than from the programs themselves. Many
 > UNIX programs do quite trivial things in isolation, but, combined with
 > other programs, become general and useful tools.



Flera av idéerna som beskrevs stämmer bra in på Anax-MVC, som till exempel att:

* pather är routes.
* hanteringen sköts av controllers.
* controllers är klasser.
* actions är metoder.

Det känns positivt att det vi har läst om i kursen är så generellt och
en vedertagen terminologi och inte något som är specifikt för ett enda system.

Själva uppgiften gick ganska smidigt. Jag tog fasta på kommentarerna om att
kring-arbetet kunde ta mycket tid och valde därför att göra en ganska enkel modul.
Med facit i hand känns det som rätt beslut. Även om själva utvecklingsarbetet
gick ganska fort har stegen med att testa, dokumentera och publicera ätit upp
resten av tiden för kursmomentet.

Mitt paket, HTMLTable, kan användas för att skapa en HTML-tabell utifrån en array
med objekt (till exempel ett sökresultat).

**Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?**<br>
Inspirationen kom helt enkelt av att jag har försökt göra ungefär det här under olika
uppgifter både i `htmlphp` och `oophp`. Då har det stupat på att jag tyckte att mina
lösningar blev för specialiserade och för hårt knutna till de aktuella uppgifterna
för att vara generellt användbara. Den här gången hade jag tillräckliga
kunskaper för att göra en mer generell lösning.

Själva koden är skriven från grunden. Utöver min klass skrev jag två exempel på
hur man kan använda den. Det ena är en enkel sid-kontroller som man kan kopiera
in i `webroot` på en standard-installation av Anax-MVC för att använda klassen.
Det andra exemplet är en helt fristående sida, som även fick dubblera som test-kod
för att skapa ett par varianter av tabeller.

**Hur gick det att utveckla modulen och integrera i ditt ramverk?**<br>
Det gick smidigt i båda fallen. Själva klassen är inte så stor, men jag ville ha
tid att skriva en ordentlig README och lite testkod/exempel också. Integrationen
med Anax gick också enkelt. Klassen i sig har ingen direkt koppling till Anax.
Det tycker jag är bra eftersom man normalt strävar efter klasser som är så
oberoende av sin miljö som möjligt. I min egen sid-kontroller som demonstrerar
klassen återanvände jag User-klassen från förra kursmomentet för att hämta data
till tabellen.

**Hur gick det att publicera paketet på Packagist?**<br>
Enklare än jag trodde att det skulle bli, faktiskt. Att utgå från en befintlig
`composer.json` underlättade och guiden på Packagist om hur man kopplar
till GitHub var tydlig.

**Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?**<br>
Det gick bra, men det är lätt att underskatta hur mycket tid test och dokumentation
tar. Jag klonade helt enkelt originalversionen av Anax-MVC till en helt ny folder,
lade till mitt paket som beroende och installerade det. I det skedet hade jag
ingen sid-kontroller för att använda min klass, men insåg att det nog var det
enklaste sättet både att testa installationen och att exemplifiera för andra hur
den kan användas.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**<br>
Ja. Jag tänkte att det skulle vara intressant att prova att integrera ett helt
fristående paket, som inte är anpassat för Anax, för att se hur det skulle gå. Det
blev en enkel RSS/Atom-läsare som inte hade några egna beroenden till andra paket
för att inte integrationen skulle bli för komplicerad.

Integrationen gick enkelt. Efter att ha lagt till klassen som ett beroende och
installerat den var det bara att skriva lite kod som använde den.

Både exemplet med mitt egna paket och RSS-paketet ligger samlade på samma menyval
på min me-sida med lite enkel styling.

Kmom06: Verktyg och CI
----------------------
Det här kursmomentet var ganska beskedligt. Efter pärsen i kmom04 jämnade det
ut sig lite nu.

På det stora hela har momentet gått bra. Jag hade några småproblem längs
vägen, men med hjälp av Google och Stackoverflow löste de sig.

Till att börja med hade den version av phpunit som ingick i min XAMPP installation
platsat i Antikrundan. Installerad version var 3.6.0 och aktuell
version 5.2.5. Det var enkelt åtgärdat genom att hämta den aktuella
versionen med `wget` och ersätta den befintliga filen.

Xdebug verkade krångligare att få igång. Jag började följa installationsguiden
på deras site, men under processens gång upptäckte jag att `xdebug.so`
fanns i XAMPP och att det enda som behövdes var en rad i `php.ini` och en
omstart av Apache. När jag väl sett det gick det enkelt.

Kommandot för att kontrollera code coverage gav felet
`No whitelist configured, no code coverage will be generated`, men det löste sig
genom att döpa om `.phpuit.xml` till `phpunit.xml` och köra kommandot som
`phpunit --bootstrap test/config.php --coverage-html ./report`.

När jag skulle skriva enhetstester för min modul valde jag mellan att göra
ett mer generellt test (som t ex använder regexp för att kontrollera att den
returnerade HMTL-koden är korrekt) eller testa på exakta returnerade strängar.
Det blev tester för exakta matchningar. Fördelen att ha testfall som är
enkla att skriva och underhålla uppväger nackdelen att de måste
redigeras om man t ex ändrar formateringen på den returnerade HTML-koden.
Dessutom blir det ingen risk att felaktig HTML-kod "slinker igenom" p.g.a.
något fel i regexp.

Min modul har ett par interna hjälp-funktioner som är `protected` och därmed
inte åtkomliga från testklassen. Men de används från den testade koden och
kommer därför att ingå i code coverage ändå.

**Var du bekant med några av dessa tekniker innan du började med kursmomentet?**<br>
Inte i detalj. Jag kände till begreppen och hade en ungefärlig uppfattning om
vad de innebär, men inte mer än så.

**Hur gick det att göra testfall med PHPUnit?**<br>
Ganska bra tycker jag. En begränsning i PHP är att det inte finns "package-scope"
eller "friend" så att man kan låta testklassen komma åt privata metoder och properties.
För min modul kom de skyddade metoderna att indirekt ingå i testerna ändå.

**Hur gick det att integrera med Travis?**<br>
Hur smidigt som helst (mycket tack vare den detaljerade guiden på dbwebb).
Det hade varit mer komplicerat att göra det själv från grunden, men även
det hade säkert ordnat sig. Jag fick några fel i den första versionen jag försökte
testa. De äldre versionerna av PHP klarade inte att properties initialiserades med
konkatenerade strängar. Det löste jag genom att använda HEREDOC.

**Hur gick det att integrera med Scrutinizer?**<br>
Det gick också ganska enkelt. Scrutinizer startade inte av sig själv när jag
lagt till code-coverage, men jag var nog för otålig när jag startade det manuellt.

**Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?**<br>
Verktygen i sig känns bekväma. Jag är inte helt såld på enhetstester än. För små
moduler är jag tveksam om man får utdelning för det extra arbetet, men värdet
ökar säkert med större projekt.

Det som gör mig tveksam är att jag undrar om enhetstester i den här formen
egentligen fångar så många fel eller om det bara blir en massa test av saker som
ändå fungerar.

Argumentet att enhetstester ger trygghet att göra stora förändringar håller jag
med om, och att testa manuellt blir väldigt enformigt så jag kommer säkert också
att skriva enhetstester framöver. Som kurslitteraturen argumenterade skriver man
ju ofta någon form av testkod ändå och då kan man ju lika  gärna ta vara på den.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**<br>
Inte den här gången.

Kmom07/10: Projekt och examination
----------------------------------

[Projekt på studentservern](http://www.student.bth.se/~ulbj15/dbwebb-kurser/phpmvc/kmom10/aa-sherlock/webroot/)

[Projekt på GitHub](https://github.com/bjurnemark/aa-sherlock)

**Krav 1 - 3 (Grunden)**<br>
Projektet kändes betydligt mer omfattande än projekten i htmlphp och oophp, med
en hel del olika varianter av vyerna som skulle implementeras.

Jag utgick från min aktuella Anax-MVC implementation och började med att radera
allt som jag inte räknade med att behöva för att få bättre överblick på det som
var kvar.

Den första datamodellen jag implementerade var `User`. Där fastnade jag ett tag
på dess dubbla roller, att den dels representerar den nuvarande användaren och
hanterar inloggning, utloggning och profilhantering och dels att modellen
representerar användare generellt. (T ex för att visa vem som skrivit en viss
fråga eller svar).

Min första ansats var att lägga till `User` som en service i appen för att
ha en instans tillgänglig överallt. När jag senare behövde börja hämta
information för andra användare (kopplat till innehållet) tyckte jag att den
lösningen blev väldigt rörig, så jag valde att strukturera om det och sköta
hanteringen av den aktuella användaren via `UserController` och ta bort den
separata tjänsten för User.

Ett annat skäl att inte låta användaren ligga om en tjänst var att `TInjectable`
lägger till tjänster som har använts (t ex session) på objektet så jag fick
problem när jag senare skulle spara mitt user-objekt eftersom det fanns extra
properties.

Klasserna för innehåll (frågor, svar och kommentarer) gick smidigare att implementera
eftersom de inte krävde special-hantering i stil med user-klassen. I efterhand
tror jag att det hade varit bättre att börja med de delarna och vänta med att
implementera login/logout och profilhantering tills huvuddelen av funktionaliteten
var på plats. Då hade det varit enklare att se vad som var särskiljande
för user och att komma rätt i implementationen från början.

Eftersom det inte fanns krav på att kunna redigera frågor, svar och kommentarer
höll jag datamodellerna så enkla som möjligt utan kolumner för `updated`. Det
gör även att innehåll kan sorteras på id eftersom det är en stigande sekvens.

Vad gäller taggarna valde jag att låta det finnas en fast uppsättning taggar
att välja från och att koppla taggarna till frågorna via en länktabell. När man ska hantera
två olika datamodeller (frågor och taggar) som är kopplade märker man
begränsningarna i ramverket. Strukturen fungerar väldigt bra så länge man har en
rak koppling mellan modellerna och de underliggande tabellerna, men här blev det
knivigare. Jag ville hålla fast vid upplägget med modeller så jag skapade en
separat modell för länktabellen, (`Linktags`) men jag är inte säker på att det verkligen
var det bästa sättet att lösa det på. Det är möjligt att det hade varit tydligare
att låta någon av de andra klasserna hantera länktabellen direkt via databas-tjänsten.

Formuleringen _När man listar en tagg kan man se de frågor som har den taggen_ i
kraven tyckte jag var otydlig. Jag tolkade det som samma krav som i meningen efter
_Klicka på en tagg för att komma till de frågor som har taggen kopplat till sig_
och det är det jag har implementerat.

Ett alternativ jag funderade på var att låta användarna lägga till taggar som
fritext, men för en riktig webbplats hade det blivit helt ohanterligt med taggar
som var inkonsekventa, felstavade och otydliga så lösningen med en fast uppsättning
taggar känns mer realistisk. På en riktig site hade det behövts en mer
avancerad lösning. Att visa en lista som nu blir opraktiskt när
antalet taggar växer.

Förstasidans översikt över "mest aktiva" valde jag att basera på antalet
ställda frågor. (En mer avancerad lösning vore att även räkna svar och
 kommentarer och sätta det i relation till någon period, t ex senaste 7
dagarna).

Layouten baserade jag på grids men gick ifrån `semantic.gs`. Den mixin
jag har använt ligger i `mixins.less` och värdena för antalet kolumner, bredder etc
är definierade i `variables.less`. Jag hade en hel del problem med layouten, särskilt
när jag försökte göra ytterligare styling med t ex margins eller padding vilket
gjorde att element trillade ner på nästa "rad". I efterhand är jag tveksam till
om det var rätt att använda grids. Jag borde kanske enbart använt dem för mina
regioner/wrappers och stylat resten med fasta värden. Jag är inte helt nöjd
med stylingen av siten, men den har redan tagit alldeles för mycket tid i anspråk
så det får vara som det är.

Många länkar använder `anchor-anonymous` så lite guidning kan vara på sin plats 
(även om jag tror att det följer bekanta mönster):

* Klicka på användarnamnet i headern för att redigera profil.
* Klicka på frågornas rubrik för att komma till fråge-vyn (med taggar, kommentarer och svar).
* Klicka på användare (på förstasidan eller användarsidan) för att se frågor/svar från användaren.
* Klicka på taggar (på förstasidan, tag-sidan eller i fråge-vyn) för att se frågor som har taggen.

När jag publicerat siten fick jag valideringsfel för zoom-instruktionen i clearfix.
Det verkar vara ett [känt](http://stackoverflow.com/questions/21166019/w3c-validator-css3-and-bootstrap) problem,
så jag tog bort zoom-raden ur clearfix för att kunna validera övriga delar.

Under utvecklingen skapade jag ett par routes för att kunna återställa databasen
med testdata och för att kunna skriva ut debug-information. De ligger kvar i
`index.php` men det finns inga länkar till dem utan man får skriva in URL:erna
direkt för att använda dem `webroot/setup` resp `webroot/debug`.

Exempeldatat är på engelska eftersom projektet skulle publiceras på GitHub.

De användare som finns fördefinierade har login (lösenordet är lika med loginnamnet):

* 'SH'
* 'Dr. Watson'
* 'Jim M'
* 'Arthur'
* 'Jane'
* 'Mr. Anderson'
* 'Molly'


Kända begränsningar i lösningen är:

* Tags-vyn visar bara taggar som används (men alla är valbara när man skriver frågor).
* Det finns inget sätt att göra undelete på användare via UI.

**Krav 4 (optionellt)**<br>
Ej implementerat.

**Krav 5 (optionellt)**<br>
Det här kravet är till större delen implementerat. Även om krav 4 (frågor) inte
är implementerat hade jag, som förberedelse, lagt till kolumner för att spara
ranking (antal röster) på frågor, svar och kommentarer och testdatat har värden för detta. Jag
har därför låtit ranking ingå i beräkningen av användarens rykte, trots
att det inte är möjligt att rösta via webbsidan. Däremot hade jag ingen representation
av hur många gånger en användare har röstat, så det är inte med i "rykte".

Mina tabeller för frågor, svar och kommentarer har enhetliga kolumnnamn så långt 
det är möjligt. Det gjorde att det var möjligt att implementera funktionen för att
hämta antalet frågor, svar eller kommentarer som en trait som inkluderas i respektive 
modell-klass. 

Jag funderade på att istället lägga till en nivå i klass-hierarkin
och lägga funktionen där. Just nu var det inte mycket annat som 
kunde flyttas till en gemensam föräldraklass. Med lite omskrivningar hade det
gått att bryta ut mer kod, men jag är inte säker på att det hade inneburit 
någon förenkling eftersom man hade behövt jobba runt de delar som skiljer mellan 
de olika innehållstyperna.

**Krav 6 (optionellt)**<br>
Ej implementerat.

**Genomförande**<br>
De flesta av de problem jag hade har jag redan tagit upp. Några erfarenheter som
jag tar med mig är:

* Börja med enkla flöden för att få upp något som går att köra tidigt i projektet
och för att få mer kunskap om projektet/kontexten innan arbetet med de svårare
bitarna. Specifikt borde jag ha väntat med användarhanteringen tills jag hade
grunderna för att skapa/visa innehåll på plats.

* Gör bara minimal styling till att börja med. Jag fastnade på stylingen och de
problem jag hade med grids tidigt i projektet. Det hade varit bättre att vänta
med det arbetet tills alla delar som ska visas finns på plats för att slippa göra
om styling på tidiga delar.

* Det blir svårt att felsöka via utskrifter när man har stora strukturer
(som t ex `$app`). Ett tag övervägde jag att installera NetBeans och testa
debuggern där, men dels skulle det stjäla för mycket tid och dels såg jag att
omdömena på nätet var ganska blandade.

Egentligen var projektet i sig inte så svårt, det var mest detaljer jag fastnade på
och att projektet var omfattande i mängden vyer/urval som behövs för att uppfylla
alla krav.

Det som gick lätt, och som verkligen känns som ramverkens styrka, är att skapa och
visa data för klasser där det finns ett ett-till-ett förhållande till en databastabell.
Med andra ord, att man inte är beroende av att hantera data i flera tabeller i en
transaktion.

Projektet har tagit lång tid. Till viss del beror det på de problem jag haft med
styling och hanteringen av user, men samtidigt kan inte tidsuppskattningar
utgå från att allt ska gå som på räls, i synnerhet inte i en lärosituation.

Projektet var bra så till vida att det gav möjlighet att använda ramverket och det
vi gått igenom i kursen. Däremot tycker jag att det är för omfattande för att vara
rimligt.

**Kursen i stort**<br>
Kursen har varit bra på det stora hela. Delar av den är för omfattande
för att de ska gå att genomföra på den utsatta tiden. Det gällde särskilt Kmom01,
Kmom04 och projektet. (I viss mån kompenseras det av Kmom05 och Kmom06 som är mindre).
Det beror inte i första hand på att materialet är svårt utan snarare att det är _mycket_
att arbeta igenom.

Kursboken tyckte jag var "sådär". För att få större behållning av den hade jag behövt
jobba mer med exemplen och koden i boken, men det har det inte funnits tid för. Hade
man gjort det har boken säkert mer att ge.

Jag tycker man borde överväga att bygga upp kursen kring något av de etablerade ramverken
istället för Anax-MVC. Det finns givetvis fördelar med att använda ett ramverk
som ni har kontroll över men det hade varit mer användbart att öva på att implementera
lösningarna i något av de mer spridda ramverken. Men, eftersom Anax-MVC är snarlikt
andra ramverk blir det mesta vi gått igenom ändå generellt användbart och det är bra.

I den här kursen har rättningen gått betydligt snabbare än i de tidigare, vilket är
mycket positivt. Det har även varit mer konkret feedback, vilket också är bra.

Jag skulle rekommendera kursen till en kollega om de ska jobba med
PHP-ramverk eller mer avancerad PHP och ger den betyg 7.
