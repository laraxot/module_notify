---
title: Creare Notifica
description: Creare Notifica
extends: _layouts.documentation
section: content
---

# Creare Notifica

Per creare una notifica, andare nella dashboard nel modulo Notify.
Cliccare sul tasto Create in alto a destra.  

Inserire la lingua della notifica (esempio italiano o inglese).  
Inserire il tipo di notifica (esempio email o sms).  
Inserire il mittente che verrà visualizzato.  
In caso si stia creando una email, inserire l'indirizzo mittente se diverso da quello di default.  
Inserire il soggetto della notifica.  
Inserire nel campo body il corpo della notifica e ricopiarlo nel campo body_html (utilizzato per le email).  

## Il body

Alcune volte può capitare che la notifica inviata sia personalizzata,  
quindi che abbia al suo interno informazioni che possono variare in base al destinatario,  
come ad esempio il nome.  

In questo caso la notifica dovrà utilizzata dovrà avere dei parametri nella sua chiamata.  
Questi parametri dovranno essere utilizzati nel corpo della notifica, esempio:  
```php
Ciao [profile.first_name] [profile.last_name] come stai?
```

Ciò significa che per utilizzare questa email, come parametro dovrà avere un array profile,  
con all'interno first_name e last_name.