<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace hollodotme\IdentityAndAccess\Tests\Init\Client;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class IdaApiClient
 * @package hollodotme\IdentityAndAccess\Tests\Init\Client
 */
class IdaApiClient
{
	const BASE_URL = 'http://localhost/api/v1';

	public function registerTenant( string $tenantName ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/tenant' ),
			[
				'tenantName' => $tenantName,
			]
		);
	}

	private function getUrl( string $path ): string
	{
		return self::BASE_URL . $path;
	}

	public function blockTenant( string $tenantId ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/tenant/block' ),
			[
				'tenantId' => $tenantId,
			]
		);
	}

	public function unblockTenant( string $tenantId ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/tenant/unblock' ),
			[
				'tenantId' => $tenantId,
			]
		);
	}

	public function listTenants(): array
	{
		return $this->executeGetRequest( $this->getUrl( '/tenant/list' ), [] );
	}

	public function registerIdentity( string $email, string $passphrase, string $name ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/identity' ),
			[
				'email'    => $email,
				'password' => $passphrase,
				'name'     => $name,
			]
		);
	}

	public function blockIdentity( string $identityId ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/identity/block' ),
			[
				'identityId' => $identityId,
			]
		);
	}

	public function unblockIdentity( string $identityId ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/identity/unblock' ),
			[
				'identityId' => $identityId,
			]
		);
	}

	public function changeIdentityEmail( string $identityId, string $email ): string
	{
		return $this->executePostRequest(
			$this->getUrl( '/identity/email' ),
			[
				'identityId'    => $identityId,
				'identityEmail' => $email,
			]
		);
	}

	public function listIdentities(): array
	{
		return $this->executeGetRequest( $this->getUrl( '/identity/list' ), [] );
	}

	private function executePostRequest( string $url, array $params ): string
	{
		$headers = ["Cache-Control: no-cache"];

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );

		$result    = curl_exec( $ch );
		$curlInfo  = curl_getinfo( $ch );
		$curlError = curl_error( $ch );

		curl_close( $ch );

		return sprintf(
			'%d %s%s',
			$curlInfo['http_code'],
			print_r( $result, true ),
			$curlError ? " ({$curlError})" : ''
		);
	}

	private function guardCurlRequestSucceeded( array $curlInfo, string $curlError )
	{
		if ( $curlInfo['http_code'] !== HttpCode::OK )
		{
			throw new \Exception( 'cURL request failed with error: ' . $curlError );
		}
	}

	private function executeGetRequest( string $url, array $params ): array
	{
		$headers = ["Cache-Control: no-cache"];

		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL, $url . '?' . http_build_query( $params ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

		$result    = curl_exec( $ch );
		$curlInfo  = curl_getinfo( $ch );
		$curlError = curl_error( $ch );

		curl_close( $ch );

		$this->guardCurlRequestSucceeded( $curlInfo, $curlError );

		return json_decode( $result, true );
	}
}
