export type User = {
	id: number;
	name: string;
	email: string;
	password: string;
	role: string;
	created_at?: string;
	updated_at?: string;
};

export type Client = {
	id: number;
	name: string;
	active: boolean;
	fee: number;
	created_at?: string;
	updated_at?: string;
};

export type ClientEditable = {
	name: string;
	active: boolean;
	fee: number | null;
};

export type ClientAdd = {
	name: string;
	active: boolean;
	fee: number | null;
};

export type UserClient = {
	user_id: number;
	client_id: number;
	owner: boolean;
	created_at?: string;
	updated_at?: string;
};

export type Seller = {
	id: number;
	name: string;
	hash: string;
	active: boolean;
	client_id: number;
	created_at?: string;
	updated_at?: string;
};

export type SellerEditable = {
	name: string;
	active: boolean;
};

export type SellerAdd = {
	name: string;
	active: boolean;
	hash: string;
	client_id: number | string;
};

export type Account = {
	id: number;
	name: string;
	number: string;
	client_id: number;
	sequence?: number;
	created_at?: string;
	updated_at?: string;
};

export type AccountEditable = {
	name: string;
	number: string;
	sequence?: number | null;
};

export type AccountAdd = {
	name: string;
	number: string;
	client_id: number;
	sequence?: number | null;
};

export type ApiKey = {
	id: number;
	key: string;
	account_id: number;
	created_at?: string;
	updated_at?: string;
};

export type Sequence = {
	id: number;
	generator: string;
	last_used: string;
	client_id: number;
	created_at?: string;
	updated_at?: string;
};

export type SequenceEditable = {
	last_used: string;
};

export type SequenceAdd = {
	generator: string;
	last_used: string;
	client_id: number;
};

export type Generated = {
	id: number;
	amount: number;
	variable_symbol: string;
	seller_id: number;
	account_id: number;
	success: boolean;
	created_at?: string;
	updated_at?: string;
};

export type GeneratedEditable = {
	success: boolean;
};

export type GeneratedAdd = {
	amount: number;
	variable_symbol: string;
	seller_id: number;
	account_id: number;
	success: boolean;
};
