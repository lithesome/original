function equal(first, second) {
	return first === second;
}

function parse_url(url) {
	let parser = document.createElement('a');
	parser.href = url;
	return {
		href: parser.href,
		host: parser.host,
		protocol: parser.protocol,
		hostname: parser.hostname,
		port: parser.port,
		pathname: parser.pathname,
		search: parser.search,
		hash: parser.hash,
	};
}

function str_replace(search, replace, subject) {
	let result = subject;
	if (typeof search !== 'string') {
		for (let i = 0; i < count(search); i++) {
			let regex = new RegExp(search[i].replace(/(\W)/g, '\\$1'), "g");
			let place = (typeof replace !== 'string') ? replace[i] : replace;
			result = result.replace(regex, place);
		}
	} else {
		let regex = new RegExp(search.replace(/(\W)/g, '\\$1'), "g");
		result = result.replace(regex, replace);
	}
	return result;
}

function strtoupper(string) {
	return string.toUpperCase();
}

function strtolower(string) {
	return string.toLowerCase();
}

function str_ireplace(search, replace, subject) {
	let result = subject;
	if (typeof search !== 'string') {
		for (let i = 0; i < count(search); i++) {
			let regex = new RegExp(search[i].replace(/(\W)/g, '\\$1'), "gi");
			let place = (typeof replace !== 'string') ? replace[i] : replace;
			result = result.replace(regex, place);
		}
	} else {
		let regex = new RegExp(search.replace(/(\W)/g, '\\$1'), "gi");
		result = result.replace(regex, replace);
	}
	return result;
}

function array_keys(array) {
	let array_keys = [];
	for (let key in array) {
		array_keys.push(key);
	}
	return array_keys;
}

function array_values(array) {
	let array_values = [];
	for (let key in array) {
		array_values.push(array[key]);
	}
	return array_values;
}

function isset(s) {
	return !is_null(s) && defined(s);
}

function empty(s) {
	if (!defined(s)) {
		return true;
	}
	if (!defined(s.length)) {
		return true;
	}
	return s.length === 0;
}

function count(s) {
	if (defined(s.length)) {
		return s.length;
	}
	return 0;
}

function is_null(s) {
	return s === null;
}

function define(variable, value) {
	if (!defined(window[variable])) {
		window[variable] = value;
		return true;
	}
	console.error('Variable `' + variable + '` already defined!');
	return false;
}

function defined(variable) {
	return variable !== undefined;
}

function explode(delimiter, string) {
	if (defined(string)) {
		return string.split(delimiter);
	}
	return [];
}

function implode(glue, array) {
	if (typeof array !== "object") {
		return array;
	}
	return array.join(glue);
}

function join(glue, array) {
	return implode(glue, array);
}

function rand(min, max = false) {
	return Math.floor(Math.random() * (max - min + 1) + min);
}

function htmlspecialchars_decode(str) {
	return str.replace(/&quot;/g, '"')
		.replace(/&apos;/g, '\'')
		.replace(/&#039;/g, '\'')
		.replace(/&gt;/g, '>')
		.replace(/&lt;/g, '<')
		.replace(/&amp;/g, '&');
}