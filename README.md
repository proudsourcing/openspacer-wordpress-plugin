# proudsourcing-wordpress-plugin

Wordpress plugin to get data from OpenSpacer REST API.


## Usage

	[openspacer api=events id=1 key=title]
	[openspacer api=sessions id=1 key=title]	


### API event data

	[openspacer api=events id=EVENTID key=DATAKEY]
	
	Overview data keys:
	- title
	- url
	- description
	- sessionCount
	- participantsCount
	- sessions (lists all event sessions)
	- participants (lists all participants)


### API session data

	[openspacer api=sessions id=SESSIONID key=DATAKEY]
	
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
	

## Changelog

	1.0.0	27.10.2014		Release


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

	Proud Sourcing GmbH 2014
	www.proudsourcing.de / openspacer.org
	
	
