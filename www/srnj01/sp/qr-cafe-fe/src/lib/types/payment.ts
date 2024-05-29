export type Payment = {
	amount: number;
	currency: string;
	targetAccount: string;
	variableSymbol: string;
	message: string;
	instant: boolean;
};
