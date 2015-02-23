# proudsourcing-wordpress-plugin

Wordpress plugin to get data from OpenSpacer REST API.


## Usage

	1. Upload plugin to wordpres
	2. go to admin plugin configuration
	3. add event-id and api-key
	4. have fun ;-)


## Usage

	[openspacer api=events key=title]
	[openspacer api=sessions key=title]
	
	[openspacer api=sessions id=1 key=title]
	id (event-id) optinal, main event-id configurable in wordpress admin plugin configuration


### API event data

	[openspacer api=events key=DATAKEY]
	
	Overview data keys:
	- title
	- url
	- description
	- sessionCount
	- participantsCount
	- sessions (lists all event sessions)
	- participants (lists all participants)


### API session data

	[openspacer api=sessions key=DATAKEY]
	
	Overview data keys:
	- title
	- url
	- abstract
	- description
	- ownerName
	- ownerUrl
	- tags
	- likes
	- comments

### API event participants
	
	[openspacer api=events key=participants data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- name (Participant name)
	- url (create anchor)
	- picture (display the participant profile picture)
	- city (display participant city)
	
	List class (ps-participants)

### API speakers
	
	[openspacer api=events key=speakers data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- name (Speaker name)
	- url (create anchor)
	- picture (display the participant profile picture)
	- city (display participant city)
	
	List class (ps-speakers)

### API session list
	
	[openspacer api=events key=sessions data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- title (Session title)
	- url (create session anchor)
	- ownerName (Session owner name)
	- ownerUrl (create session owner anchor)

	List class (ps-sessions

### CSS style

	- ul class (ps-list)
	- li class (ps-list-element)
	- a class (ps-anchor)
	- img class (ps-picture)
	

## Changelog

	2.0.0	23.02.2015		Release 2.0
	1.0.0	27.10.2014		Release 1.0


## License

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    

## Copyright

	Proud Sourcing GmbH 2015
	www.proudsourcing.de / openspacer.org
	
	
