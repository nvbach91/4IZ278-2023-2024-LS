export interface User {
	id: number;
	name: string;
	email: string;
	password: string;
	role: string;
	created_at?: string;
	updated_at?: string;
	clients?: Client[];
}

export interface Client {
	id: number;
	name: string;
	active: boolean;
	fee: number;
	created_at?: string;
	updated_at?: string;
}
