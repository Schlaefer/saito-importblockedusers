# Saito User Block Import #

## What ##

Plugin for [Saito-Forum][saito]. Imports blocked users from pre Saito 4.4 into the 4.4+ blocking system.

Requires Saito 4.6+

[saito]: https://github.com/Schlaefer/Saito

## Install ##

Copy the files into `app/Plugin/ImportBlockedUser`.

Add to `app/Config/saito_config.php`:

```php
CakePlugin::load('ImportBlockedUsers', ['bootstrap' => true, 'routes' => true]);
```

## Usage ##

After installation the plugin is available in the admin-backend.

## Uninstall ##

Undo the steps from Install.