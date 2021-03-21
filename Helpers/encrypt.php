<?php

	function encodeMd2($str, $raw_output = false)
	{
		return hash('md2', $str, $raw_output);
	}

	function encodeMd4($str, $raw_output = false)
	{
		return hash('md4', $str, $raw_output);
	}

	function encodeMd5($str, $raw_output = false)
	{
		return hash('md5', $str, $raw_output);
	}

	function encodeSha1($str, $raw_output = false)
	{
		return hash('sha1', $str, $raw_output);
	}

	function encodeSha224($str, $raw_output = false)
	{
		return hash('sha224', $str, $raw_output);
	}

	function encodeSha256($str, $raw_output = false)
	{
		return hash('sha256', $str, $raw_output);
	}

	function encodeSha384($str, $raw_output = false)
	{
		return hash('sha384', $str, $raw_output);
	}

	function encodeSha512($str, $raw_output = false)
	{
		return hash('sha512', $str, $raw_output);
	}

	function encodeRipeMd128($str, $raw_output = false)
	{
		return hash('ripemd128', $str, $raw_output);
	}

	function encodeRipeMd160($str, $raw_output = false)
	{
		return hash('ripemd160', $str, $raw_output);
	}

	function encodeRipeMd256($str, $raw_output = false)
	{
		return hash('ripemd256', $str, $raw_output);
	}

	function encodeRipeMd320($str, $raw_output = false)
	{
		return hash('ripemd320', $str, $raw_output);
	}

	function encodeWhirlpool($str, $raw_output = false)
	{
		return hash('whirlpool', $str, $raw_output);
	}

	function encodeTiger1283($str, $raw_output = false)
	{
		return hash('tiger128,3', $str, $raw_output);
	}

	function encodeTiger1603($str, $raw_output = false)
	{
		return hash('tiger160,3', $str, $raw_output);
	}

	function encodeTiger1923($str, $raw_output = false)
	{
		return hash('tiger192,3', $str, $raw_output);
	}

	function encodeTiger1284($str, $raw_output = false)
	{
		return hash('tiger128,4', $str, $raw_output);
	}

	function encodeTiger1604($str, $raw_output = false)
	{
		return hash('tiger160,4', $str, $raw_output);
	}

	function encodeTiger1924($str, $raw_output = false)
	{
		return hash('tiger192,4', $str, $raw_output);
	}

	function encodeSnefru($str, $raw_output = false)
	{
		return hash('snefru', $str, $raw_output);
	}

	function encodeSnefru256($str, $raw_output = false)
	{
		return hash('snefru256', $str, $raw_output);
	}

	function encodeGost($str, $raw_output = false)
	{
		return hash('gost', $str, $raw_output);
	}

	function encodeGostCrypto($str, $raw_output = false)
	{
		return hash('gost-crypto', $str, $raw_output);
	}

	function encodeAdler32($str, $raw_output = false)
	{
		return hash('adler32', $str, $raw_output);
	}

	function encodeCrc32($str, $raw_output = false)
	{
		return hash('crc32', $str, $raw_output);
	}

	function encodeCrc32b($str, $raw_output = false)
	{
		return hash('crc32b', $str, $raw_output);
	}

	function encodeFnv132($str, $raw_output = false)
	{
		return hash('fnv132', $str, $raw_output);
	}

	function encodeFnv1a32($str, $raw_output = false)
	{
		return hash('fnv1a32', $str, $raw_output);
	}

	function encodeFnv164($str, $raw_output = false)
	{
		return hash('fnv164', $str, $raw_output);
	}

	function encodeFnv1a64($str, $raw_output = false)
	{
		return hash('fnv1a64', $str, $raw_output);
	}

	function encodeJoaat($str, $raw_output = false)
	{
		return hash('joaat', $str, $raw_output);
	}

	function encodeHaval1283($str, $raw_output = false)
	{
		return hash('haval128,3', $str, $raw_output);
	}

	function encodeHaval1603($str, $raw_output = false)
	{
		return hash('haval160,3', $str, $raw_output);
	}

	function encodeHaval1923($str, $raw_output = false)
	{
		return hash('haval192,3', $str, $raw_output);
	}

	function encodeHaval2243($str, $raw_output = false)
	{
		return hash('haval224,3', $str, $raw_output);
	}

	function encodeHaval2563($str, $raw_output = false)
	{
		return hash('haval256,3', $str, $raw_output);
	}

	function encodeHaval1284($str, $raw_output = false)
	{
		return hash('haval128,4', $str, $raw_output);
	}

	function encodeHaval1604($str, $raw_output = false)
	{
		return hash('haval160,4', $str, $raw_output);
	}

	function encodeHaval1924($str, $raw_output = false)
	{
		return hash('haval192,4', $str, $raw_output);
	}

	function encodeHaval2244($str, $raw_output = false)
	{
		return hash('haval224,4', $str, $raw_output);
	}

	function encodeHaval2564($str, $raw_output = false)
	{
		return hash('haval256,4', $str, $raw_output);
	}

	function encodeHaval1285($str, $raw_output = false)
	{
		return hash('haval128,5', $str, $raw_output);
	}

	function encodeHaval1605($str, $raw_output = false)
	{
		return hash('haval160,5', $str, $raw_output);
	}

	function encodeHaval1925($str, $raw_output = false)
	{
		return hash('haval192,5', $str, $raw_output);
	}

	function encodeHaval2245($str, $raw_output = false)
	{
		return hash('haval224,5', $str, $raw_output);
	}

	function encodeHaval2565($str, $raw_output = false)
	{
		return hash('haval256,5', $str, $raw_output);
	}

	function encodeMd2File($filename, $binary = false)
	{
		return hash_file('md2', $filename, $binary);
	}

	function encodeMd4File($filename, $binary = false)
	{
		return hash_file('md4', $filename, $binary);
	}

	function encodeMd5File($filename, $binary = false)
	{
		return hash_file('md5', $filename, $binary);
	}

	function encodeSha1File($filename, $binary = false)
	{
		return hash_file('sha1', $filename, $binary);
	}

	function encodeSha224File($filename, $binary = false)
	{
		return hash_file('sha224', $filename, $binary);
	}

	function encodeSha256File($filename, $binary = false)
	{
		return hash_file('sha256', $filename, $binary);
	}

	function encodeSha384File($filename, $binary = false)
	{
		return hash_file('sha384', $filename, $binary);
	}

	function encodeSha512File($filename, $binary = false)
	{
		return hash_file('sha512', $filename, $binary);
	}

	function encodeRipeMd128File($filename, $binary = false)
	{
		return hash_file('ripemd128', $filename, $binary);
	}

	function encodeRipeMd160File($filename, $binary = false)
	{
		return hash_file('ripemd160', $filename, $binary);
	}

	function encodeRipeMd256File($filename, $binary = false)
	{
		return hash_file('ripemd256', $filename, $binary);
	}

	function encodeRipeMd320File($filename, $binary = false)
	{
		return hash_file('ripemd320', $filename, $binary);
	}

	function encodeWhirlpoolFile($filename, $binary = false)
	{
		return hash_file('whirlpool', $filename, $binary);
	}

	function encodeTiger1283File($filename, $binary = false)
	{
		return hash_file('tiger128,3', $filename, $binary);
	}

	function encodeTiger1603File($filename, $binary = false)
	{
		return hash_file('tiger160,3', $filename, $binary);
	}

	function encodeTiger1923File($filename, $binary = false)
	{
		return hash_file('tiger192,3', $filename, $binary);
	}

	function encodeTiger1284File($filename, $binary = false)
	{
		return hash_file('tiger128,4', $filename, $binary);
	}

	function encodeTiger1604File($filename, $binary = false)
	{
		return hash_file('tiger160,4', $filename, $binary);
	}

	function encodeTiger1924File($filename, $binary = false)
	{
		return hash_file('tiger192,4', $filename, $binary);
	}

	function encodeSnefruFile($filename, $binary = false)
	{
		return hash_file('snefru', $filename, $binary);
	}

	function encodeSnefru256File($filename, $binary = false)
	{
		return hash_file('snefru256', $filename, $binary);
	}

	function encodeGostFile($filename, $binary = false)
	{
		return hash_file('gost', $filename, $binary);
	}

	function encodeGostCryptoFile($filename, $binary = false)
	{
		return hash_file('gost-crypto', $filename, $binary);
	}

	function encodeAdler32File($filename, $binary = false)
	{
		return hash_file('adler32', $filename, $binary);
	}

	function encodeCrc32File($filename, $binary = false)
	{
		return hash_file('crc32', $filename, $binary);
	}

	function encodeCrc32bFile($filename, $binary = false)
	{
		return hash_file('crc32b', $filename, $binary);
	}

	function encodeFnv132File($filename, $binary = false)
	{
		return hash_file('fnv132', $filename, $binary);
	}

	function encodeFnv1a32File($filename, $binary = false)
	{
		return hash_file('fnv1a32', $filename, $binary);
	}

	function encodeFnv164File($filename, $binary = false)
	{
		return hash_file('fnv164', $filename, $binary);
	}

	function encodeFnv1a64File($filename, $binary = false)
	{
		return hash_file('fnv1a64', $filename, $binary);
	}

	function encodeJoaatFile($filename, $binary = false)
	{
		return hash_file('joaat', $filename, $binary);
	}

	function encodeHaval1283File($filename, $binary = false)
	{
		return hash_file('haval128,3', $filename, $binary);
	}

	function encodeHaval1603File($filename, $binary = false)
	{
		return hash_file('haval160,3', $filename, $binary);
	}

	function encodeHaval1923File($filename, $binary = false)
	{
		return hash_file('haval192,3', $filename, $binary);
	}

	function encodeHaval2243File($filename, $binary = false)
	{
		return hash_file('haval224,3', $filename, $binary);
	}

	function encodeHaval2563File($filename, $binary = false)
	{
		return hash_file('haval256,3', $filename, $binary);
	}

	function encodeHaval1284File($filename, $binary = false)
	{
		return hash_file('haval128,4', $filename, $binary);
	}

	function encodeHaval1604File($filename, $binary = false)
	{
		return hash_file('haval160,4', $filename, $binary);
	}

	function encodeHaval1924File($filename, $binary = false)
	{
		return hash_file('haval192,4', $filename, $binary);
	}

	function encodeHaval2244File($filename, $binary = false)
	{
		return hash_file('haval224,4', $filename, $binary);
	}

	function encodeHaval2564File($filename, $binary = false)
	{
		return hash_file('haval256,4', $filename, $binary);
	}

	function encodeHaval1285File($filename, $binary = false)
	{
		return hash_file('haval128,5', $filename, $binary);
	}

	function encodeHaval1605File($filename, $binary = false)
	{
		return hash_file('haval160,5', $filename, $binary);
	}

	function encodeHaval1925File($filename, $binary = false)
	{
		return hash_file('haval192,5', $filename, $binary);
	}

	function encodeHaval2245File($filename, $binary = false)
	{
		return hash_file('haval224,5', $filename, $binary);
	}

	function encodeHaval2565File($filename, $binary = false)
	{
		return hash_file('haval256,5', $filename, $binary);
	}