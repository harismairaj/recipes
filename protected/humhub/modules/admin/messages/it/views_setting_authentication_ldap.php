<?php
return array (
  'A TLS/SSL is strongly favored in production environments to prevent passwords from be transmitted in clear text.' => 'TLS/SSL è fortemente richiesto in ambienti di produzione per prevenire la trasmissione di password con testo in chiaro.',
  'Defines the filter to apply, when login is attempted. %s replaces the username in the login action. Example: &quot;(sAMAccountName=%s)&quot; or &quot;(uid=%s)&quot;' => 'Definisce il filtro da applicare quando si tenta di accedere. Sostituisce %s al nome utente nell\'azione di accesso. Esempio: &quot;(sAMAccountName=%s)&quot; o &quot;(uid=%s)&quot;',
  'LDAP Attribute for E-Mail Address. Default: &quotmail&quot;' => 'Attributo LDAP per l\'indirizzo E-Mail. Default: &quotmail&quot;',
  'LDAP Attribute for Username. Example: &quotuid&quot; or &quot;sAMAccountName&quot;' => 'Attributo LDAP per lo username. Esempio: &quotuid&quot; o &quot;sAMAccountName&quot;',
  'Limit access to users meeting this criteria. Example: &quot(objectClass=posixAccount)&quot; or &quot;(&(objectClass=person)(memberOf=CN=Workers,CN=Users,DC=myDomain,DC=com))&quot;' => 'Limita l\'accesso agli utenti che soddisfano questo criterio. Esempio: &quot(objectClass=posixAccount)&quot; o &quot;(&(objectClass=person)(memberOf=CN=Workers,CN=Users,DC=myDomain,DC=com))&quot;',
  'Save' => 'Salva',
  'Specify your LDAP-backend used to fetch user accounts.' => 'Specifica il tuo backend LDAP per recuperare gli account utenti',
  'Status: Error! (Message: {message})' => 'Stato: Errore! (Messaggio: {message})',
  'Status: OK! ({userCount} Users)' => 'Stato: OK! ({userCount} Utenti)',
  'Status: Warning! (No users found using the ldap user filter!)' => 'Attenzione! Non trovo utenti usanto il filtro impostato!',
  'The default base DN used for searching for accounts.' => 'La base DN predefinita usata per cercare gli account.',
  'The default credentials password (used only with username above).' => 'Password credenziale predefinita (usata solo con lo username qui sopra).',
  'The default credentials username. Some servers require that this be in DN form. This must be given in DN form if the LDAP server requires a DN to bind and binding should be possible with simple usernames.' => 'Username credenziale predefinito. Alcuni server richiedono che questo sia nella forma DN. Questo deve essere fornito nella forma DN se il server LDAP richiede un DN per vincolare e il vincolamento dovrebbe essere possible con semplici nomi utente.',
);
