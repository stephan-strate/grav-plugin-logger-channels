# Logger Channels Plugin

The **Logger Channels** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Add or replace logger handlers and targets for any grav system.

We currently support the following handlers (more can be added through pull requests):
- Discord
- Telegram

## Installation

Installing the Logger Channels plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install logger-channels

This will install the Logger Channels plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/logger-channels`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `logger-channels`. You can find these files on [GitHub](https://github.com/stephan-strate/grav-plugin-logger-channels) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/logger-channels
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/stephan-strate/grav-plugin-logger-channels/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/logger-channels/logger-channels.yaml` to `user/config/plugins/logger-channels.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
remove_default_handlers: false
```

Note that if you use the Admin Plugin, a file with your configuration named logger-channels.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

### Log Levels

Grav uses [Monolog](https://github.com/Seldaek/monolog) as logger framework. So the log levels are inherited from this library. Here is a quick overview on valid log level values for configuration:

| Level     | Value |
| --------- | ----- |
| Debug     | 100   |
| Info      | 200   |
| Notice    | 250   |
| Warning   | 300   |
| Error     | 400   |
| Critical  | 500   |
| Alert     | 550   |
| Emergency | 600   |

### Handlers

Handlers can be interpreted as targets for your log messages. They can usually be configured with a specific log level. That means you can eg. receive critical or emergency logs via email and debug/info logs to Discord. The combinations and configurations are endless. In the following chapter we will describe on how to set up the supported handlers.

Supported handlers:
- Discord
- Telegram

#### Discord

Discord uses so called webhooks to receive messages for a specific channel. Create a webhook as described in the official [documentation](https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks) and paste the url into the plugin configuration.

Example:
```yaml
handlers.discord:
  -
    webhook: https://discord.com/api/webhooks/<id>
    level: 100 # Debug
```

#### Telegram

Telegram uses bots to send messages to defined chats. You can create your own bot (see [here](https://github.com/merorafael/monolog-telegram-handler)) and paste the access token and desired chat id into the plugin configuration.

Example:
```yaml
handlers.telegram:
  -
    token: <token>
    chatid: <chat_id>
    level: 100 # Debug
```

## Credits

[Monolog](https://github.com/Seldaek/monolog) has a lot of built-in handlers as well as a bunch of third-party ones. We do not want to re-invent the wheel here and just use some [third-party](https://github.com/Seldaek/monolog/wiki/Third-Party-Packages) handlers:

- Discord: https://github.com/lefuturiste/monolog-discord-handler
- Telegram: https://github.com/merorafael/monolog-telegram-handler

## Known Limitations

* As this is a regular plugin, the log handlers are initialized and applied after some errors already could have occured. But from my testing this was never a real problem.
