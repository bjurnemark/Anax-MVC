<?php

namespace Bjurnemark\Package;

/**
 * A controller for using packages.
 *
 */
class PackageController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Column definitions.
     */
    protected $colDefs;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->users = new \Bjurnemark\Users\User();
        $this->users->setDI($this->di);

        // Set up column definitions
        $this->colDefs = [
            [
                'displayName' => 'Användare',
                'propertyName' => 'acronym',
            ],
            [
                'displayName' => 'E-post',
                'propertyName' => 'email',
            ],
            [
                'displayName' => 'Namn',
                'propertyName' => 'name',
            ],
            [
                'displayName' => 'Skapad',
                'propertyName' => 'created',
            ],
        ];
    }

    /**
     * Display main page.
     *
     * This will create a page with a table using CHTMLTable. The User class
     * is reused just to have some data to display
     *
     * @return void
     */
    public function indexAction()
    {
        // Add a description of what's done
        $this->theme->setTitle("Pakethantering");
        $content  = "<h1>HTMLTable demo</h1>\n";
        $content .= "<p>Tabellen är skapad genom att:<br>\n";
        $content .= "<ol><li>Definiera kolumner och rubriker (<code>CHTMLTable.setColumns</code>)</li>\n";
        $content .= "<li>Hämta data (<code>User.findAll</code>)</li>\n";
        $content .= "<li>Skapa HTML-kod för tabellen (<code>CHTMLTable.create</code>)</li>\n";
        $content .= "</ol>\n";

        // Get data to display
        $this->users = new \Bjurnemark\Users\User();
        $this->users->setDI($this->di);
        $users = $this->users->findAll();

        // Define and create table
        $table = new \Bjurnemark\HTMLTable\CHTMLTable();
        $table->setColumns($this->colDefs);
        $content .= $table->create($users);

        // Add RSS content using an external package
        $content .= "<h1>RSS-feed</h1>\n";
        $content .= "<p>RSS-flödet nedan är implementerat med hjälp av paketet <a href='https://packagist.org/packages/dg/rss-php'>dg/rss-php</a>\n";
        $content .= $this->readFeed('http://www.ttbook.org/book/radio/rss/feed');

        // Add view
        $this->views->add('default/blankpage', [
            'content' => $content,
        ]);
    }

    protected function readFeed($url) {
        // Read feed
        $rss = \Feed::loadRss($url);

        $out = "";
        $count = 0;

        // Add feed information to the output
        $out .= '<h2>' . $rss->title . '</h2>';
        $out .= '<p>' . $rss->description;
        $out .= '<br><a href="' . $rss->link . '">Länk</a></p>';

        // Add feed items to the output (limited to three items)
        foreach ($rss->item as $item) {
            if($count++ == 3) {
                return $out;
            }
            $out .= '<h3>' . $item->title . '</h3>';
            $out .= '<p>'  . $item->description;
            $out .= '<br><a href="' . $item->link . '">Länk</a></p>';
        }
        return $out;    // In case of fewer than 3 elements
    }
}
