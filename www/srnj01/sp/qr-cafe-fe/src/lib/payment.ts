import type { Payment } from '$types/payment';

export const paymentSerializer = (payment: Payment): string =>
	encodeURIComponent(
		[
			'SPD',
			'1.0',
			`ACC:${payment.targetAccount}`,
			`AM:${payment.amount}`,
			`CC:${payment.currency}`,
			`X-VS:${payment.variableSymbol}`,
			`MSG:${payment.message}`,
			`${payment.instant ? 'PT:IP' : ''}`
		]
			.filter(($) => $ || $ !== '')
			.join('*')
	);

export const convertToIBAN = (input: string): string => {
	let prefix: string;
	let accountNumber: string;

	const [accountPart, bankCodePart] = input.split('/');
	const bankCode = bankCodePart;

	if (accountPart.includes('-')) {
		[prefix, accountNumber] = accountPart.split('-');
	} else {
		prefix = '0';
		accountNumber = accountPart;
	}

	prefix = prefix.padStart(6, '0');
	accountNumber = accountNumber.padStart(10, '0');

	const countryCode = 'CZ';
	const checkDigits = '00';
	const bban = bankCode + prefix + accountNumber;

	const temporaryIBAN = bban + countryCode + checkDigits;
	const numericIBAN = temporaryIBAN
		.split('')
		.map((char) => {
			const code = char.charCodeAt(0);
			return code >= 65 && code <= 90 ? (code - 55).toString() : char;
		})
		.join('');

	const checkNumber = BigInt(numericIBAN) % 97n;
	const calculatedCheckDigits = (98n - checkNumber).toString().padStart(2, '0');

	const finalIBAN = countryCode + calculatedCheckDigits + bban;
	return finalIBAN;
};
