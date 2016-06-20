<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\EventMaps;

use hollodotme\IdentityAndAccess\Domain\Models\Applications\Events\ApplicationWasRegistered;

/**
 * Class ApplicationsEventMap
 * @package hollodotme\IdentityAndAccess\Application\EventMaps
 */
final class ApplicationsEventMap extends AbstractEventMap
{
	const MAP = [
		'ApplicationWasRegistered' => ApplicationWasRegistered::class,
	];
}