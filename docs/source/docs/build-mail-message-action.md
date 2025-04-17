---
title: Classe BuildMailMessageAction
description: Classe BuildMailMessageAction
extends: _layouts.documentation
section: content
---

# Classe BuildMailMessageAction

Classe, utilizzata all'interno di ThemeNotification,  
che si occupa di costruire la notifica ed aggiungere eventuali allegati.  

Al suo interno utilizza la classe **Notify\Actions\NotifyTheme\Get**.  

## Classe Notify\Actions\NotifyTheme\Get

Classe se si occupa della creazione del body_html, tramite i suoi parametri.  

I valori del parametro array $view_params devono essere tutti tipo stringa, altrimenti non verranno presi in considerazione in caso di replace delle variabili.