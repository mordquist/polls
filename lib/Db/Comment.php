<?php
/**
 * @copyright Copyright (c) 2017 Vinzenz Rosenkranz <vinzenz.rosenkranz@gmail.com>
 *
 * @author Vinzenz Rosenkranz <vinzenz.rosenkranz@gmail.com>
 * @author Kai Schröer <git@schroeer.co>
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

/**
 * @method int getId()
 * @method void setId(integer $value)
 * @method int getPollId()
 * @method void setPollId(integer $value)
 * @method string getUserId()
 * @method void setUserId(string $value)
 * @method string getComment()
 * @method void setComment(string $value)
 * @method int getTimestamp()
 * @method void setTimestamp(integer $value)
 */
class Comment extends EntityWithUser implements JsonSerializable {
	public const TABLE = 'polls_comments';

	protected array $subComments = [];
	protected int $pollId = 0;
	protected string $userId = '';
	protected int $timestamp = 0;
	protected string $comment = '';

	public function __construct() {
		$this->addType('pollId', 'int');
		$this->addType('timestamp', 'int');
	}

	/**
	 * @return array
	 */
	public function jsonSerialize(): array {
		return [
			'id' => $this->getId(),
			'pollId' => $this->getPollId(),
			'timestamp' => $this->getTimestamp(),
			'comment' => $this->getComment(),
			'user' => $this->getUser(),
			'subComments' => $this->getSubComments(),
		];
	}

	public function addSubComment(Comment $comment): void {
		$this->subComments[] = [
			'id' => $comment->getId(),
			'comment' => $comment->getComment(),
			'timestamp' => $this->getTimestamp(),
		];
	}

	public function getSubComments(): array {
		return $this->subComments;
	}
}
