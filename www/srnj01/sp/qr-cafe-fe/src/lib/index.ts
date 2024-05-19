import type { User } from '$types/user';
import { writable, type Writable } from 'svelte/store';

export const user: Writable<User | null> = writable(null);
