import type { User } from '$types/user';
import { writable, type Writable } from 'svelte/store';

export const user: Writable<User | null> = writable(null);

export const copy = (string: string) => {
	console.log('copying', string);
	if (!string) return;
	navigator.clipboard.writeText(string);
};
