<?php
/**
 * @copyright Copyright (c) 2020 Vinzenz Rosenkranz <vinzenz.rosenkranz@gmail.com>
 *
 * @author René Gieling <github@dartcafe.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Polls\Db;

use JsonSerializable;
use OCP\AppFramework\Db\Entity;

/**
 * @method integer getId()
 * @method void setId(integer $value)
 * @method string getUserId()
 * @method void setUserId(string $value)
 * @method string getTimestamp()
 * @method void setTimestamp(integer $value)
 * @method string getPreferences()
 * @method void setPreferences(string $value)
 */
class Preferences extends Entity implements JsonSerializable {
	public const TABLE = 'polls_preferences';

	protected string $userId = '';
	protected int $timestamp = 0;
	protected string $preferences = '';

	public function __construct() {
		$this->addType('timestamp', 'int');
	}
	
	public function getCheckCalendarsBefore(): int {
		if (isset(json_decode($this->getPreferences())->checkCalendarsBefore)) {
			return intval(json_decode($this->getPreferences())->checkCalendarsBefore);
		}
		return 0;
	}
	
	public function getCheckCalendarsAfter(): int {
		if (isset(json_decode($this->getPreferences())->checkCalendarsAfter)) {
			return intval(json_decode($this->getPreferences())->checkCalendarsAfter);
		}
		return 0;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize(): array {
		return [
			'id' => $this->getId(),
			'userId' => $this->getUserId(),
			'timestamp' => $this->getTimestamp(),
			'preferences' => json_decode($this->preferences),
		];
	}
}
