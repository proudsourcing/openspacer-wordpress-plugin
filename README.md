# proudsourcing-wordpress-plugin

Wordpress plugin to get data from OpenSpacer REST API.


## Installation

	1. Upload plugin to wordpres
	2. go to admin plugin configuration
	3. add event-id and api-key
	4. have fun ;-)


## Usage

	[openspacer api=events key=title]
	[openspacer api=sessions key=title]
	
	[openspacer api=sessions id=1 key=title]
	id (event-id) is optional, you can use for an alternative event (with same api-key)


### API event data

	[openspacer api=events key=DATAKEY]
	
	Overview DATAKEY:
	- title
	- url
	- description
	- sessionCount
	- participantsCount
	- sessions (lists all event sessions)
	- participants (lists all participants)


### API session data

	[openspacer api=sessions key=DATAKEY]
	
	Overview DATAKEY:
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
	- name (participant name)
	- url (participant url [creates anchor])
	- picture (participant profile picture)
	- city (participant city)
	
	List class (ps-participants)
	
	
### API event subevents
	
	[openspacer api=events key=subevents data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- title (subevent title)
	- url (subevent url [creates anchor])
	- description (subevent description)
	- sessionCount (subevent session count)
	- participantCount (subevent participant count)
	
	List class (ps-subevents)


### API speakers
	
	[openspacer api=events key=speakers data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- name (speaker name)
	- url (speaker url [creates anchor])
	- picture (speaker profile picture)
	- city (speaker city)
	
	List class (ps-speakers)


### API session list
	
	[openspacer api=events key=sessions data=DISPLAY_ATTRIBUTES]

	Available DATA_ATTRIBUTES
	- title (session title)
	- url (session url [creates anchor])
	- ownerName (session owner name)
	- ownerUrl (session owner url)

	List class (ps-sessions


### CSS style

	- ul class (ps-list)
	- li class (ps-list-element)
	- a class (ps-anchor)
	- img class (ps-picture)
	

## Changelog

	2.1.0	29.06.2015		get subevents
	2.0.0	23.02.2015		wp plugin administraiton, more data & data caching
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
	
	
