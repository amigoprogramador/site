# Backend Support plugin

This plugin adds backed-end support ticket system features to [OctoberCMS](http://octobercms.com).

So you make project for your client and installed it on production server. Congratulations!

Now comes the time for support this project. This plugin will allow your client to send your support team tickets about bugs, qustions, new features requests, etc.

Keep all client reports/messages about project in one place. No more need to search your email box for houndreds emails send by your client.

## Features
* Manage support tickets inside CMS
* Custom tickets types and statuses
* Built in messaging system for ticket

> **Important note:** This plugin is and will be only for backend usage. I am not going to connect RainLab.User plugin and make it for frontend users.

# Documentation

## Usage

After installation plugin will register backend **Support** menu position. From there you will be able to manage support tickes, manage ticket statuses and types.

### Settings

Plugin ships with a settings page. Go to **Settings** and you will see a menu item **Settings** listed under **Support** section. From there you can manage your support team, that will be notified when client create new support ticket or add new reply.

### Permissions

For your client account you should create/update his group permissions. I recommend you to only allow for **Manage tickets** permission for your clients and deny other support permissions.

### Mail templates

Plugin ships with three mail templates views. You can always modify those templates in Settings -> Mail -> Mail Templates.

**New ticket email** - this email will be send to all support team members, when client create new ticket.

**New reply message email** - this email will be send to all support team members or ticket owner. It depends who sends reply.

**Ticket was closed email** - this email will be send to ticket owner when support team close ticket.