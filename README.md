# ![hetThema](https://deidee.com/logo.png?str=hetThema)

Een standaard [WordPress](https://wordpress.org/) -thema dat bedoeld is om uit te breiden via child-thema’s.

## Installatie

1. Download [de ZIP](https://github.com/deidee/hetthema/archive/master.zip);
2. pak het bestand uit in de map `hetthema` in `wp-content/themes`;
3. activeer het thema in WordPress.

## Functies

### Debuggen

hetTheme geeft toegang tot ``jw()`` — een veredelde versie van `var_dump()`.

```php
jw( true, 
    1337,
    '<test/>',
    ['een ding', 'nog een ding'],
    (object) ['key' => 'value']
);
```

### ``phpinfo``

hetThema heeft een template voor ``phpinfo()`` ingebakken. Het enige dat je hoeft te doen is een pagina aanmaken met `phpinfo` als slug. Om veiligheidsredenen is het verstandig deze pagina niet te publiceren, maar alleen te bekijken via de preview-functie van WordPress.

### Gootsteen

hetThema heeft een template ingebakken om alle elementen en componenten mee te testen. Om hier gebruik van te maken heb je een pagina nodig met ``gootsteen`` of `kitchensink` als slug. **Dit template is nog in ontwikkeling.**

Het is verstandig om dit template vanuit een _child theme_ te overschrijven met de elementen en componenten die jouw website gebruikt.

### Default stylesheet

hetThema gebruikt standaard [Default.style](https://default.style/) als stylesheet. Dit is een stylesheet die nauwelijks uitspraken doet over vorm, maar zorgt dat tekst beter leesbaar is dan wanneer er géén stylesheet is.

Als je hetThema gebruikt als _parent theme_, wil je deze stylesheet waarschijnlijk uitschakelen. Dan kan op de volgende manier:

```php
function remove_default_style() {
	wp_dequeue_style( 'default-style' );
	wp_deregister_style( 'default-style' );
}
add_action( 'wp_enqueue_scripts', 'remove_default_style', 20 );
```

## In gebruik

Websites die hetThema in gebruik hebben:

* [The Fashionweek](https://thefashionweek.nl/)
