<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services\EventMaps;

use hollodotme\IdentityAndAccess\Domain\Models\Users\Events\UserWasInstalled;

/**
 * Class UsersEventMap
 * @package hollodotme\IdentityAndAccess\Domain\Services\EventMaps
 */
final class UsersEventMap extends AbstractEventMap
{
	const MAP = [
		'UserWasInstalled' => UserWasInstalled::class,
	];
}
