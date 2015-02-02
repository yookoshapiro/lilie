<?php

return [

    /*------------------------------------------------------------------------
    | Pfad zur Biblothek
    |-------------------------------------------------------------------------
    |
    | Der Pfad zu den Klassen und Dateien dieses Paketes die ihren eigenen
    | Namesraum erhalten
    */

    'lib' => 'lib',


    /*------------------------------------------------------------------------
    | Namesraum der Biblothek
    |-------------------------------------------------------------------------
    |
    | Der genutzt Namesraum für diese Anwendung hilft die Klasse der
    | verschiedenen Pakete von einander zu unterscheiden.
    */

    'namespace' => 'Develop',


    /*------------------------------------------------------------------------
    | Pfad zu den Seitentypen
    |-------------------------------------------------------------------------
    |
    | Ein Paket kann die Standard-Seitentypen ganz oder teilweise in deren
    | Funktionen und Ausgaben überschreiben. Hier sind Diese zu finden.
    |
    */

    'types' => 'types',


    /*------------------------------------------------------------------------
    | zusätzlich aufzurufende Dateien
    |-------------------------------------------------------------------------
    |
    | Da diese Anwendung nicht alle denkbaren Funktionalität abdenken wird,
    | können für jedes Paket zusätzliche Dateien aufgerufen werden. Die
    | Dateien müssen sich dazu im Ordner des Paketes befinden. Ein Schlüssel
    | muss nicht angegeben werden.
    |
    | Die Reihenfolge der hier aufgeführten Datei ist auch die Reihenfolge
    | in der die Anwendung die Dateien abarbeitet.
    */

    'files' => [

        //

    ]

];