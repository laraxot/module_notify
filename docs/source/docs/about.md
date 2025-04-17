---
title: About Notify
description: About Notify
extends: _layouts.documentation
section: content
---

# module_notify

module_notify è un modulo per la gestione delle notifiche.

### Installazione

Per installare il modulo, eseguire il comando seguente:

```php
composer require laraxot/module_notify
```

### Utilizzo

Per utilizzare il modulo, è necessario importarlo e creare un oggetto NotificationManager:

from module_notify import NotificationManager

manager = NotificationManager()

È possibile quindi utilizzare il metodo send_notification per inviare una notifica:

manager.send_notification("Questo è un esempio di notifica.")

Per ulteriori informazioni su come utilizzare il modulo, consultare la documentazione completa.