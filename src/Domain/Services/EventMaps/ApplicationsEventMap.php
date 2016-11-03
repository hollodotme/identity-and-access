<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services\EventMaps;

use hollodotme\IdentityAndAccess\Domain\Models\Applications\Events\ApplicationWasRegistered;

/**
 * Class ApplicationsEventMap
 * @package hollodotme\IdentityAndAccess\Domain\Services\EventMaps
 */
final class ApplicationsEventMap extends AbstractEventMap
{
	const MAP = [
		'ApplicationWasRegistered' => ApplicationWasRegistered::class,
	];
}
