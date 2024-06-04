import { PUBLIC_API_URL } from '$env/static/public';
import { create } from '.';

export const register = (
	name: string,
	email: string,
	password: string,
	passwordConfirmation: string
) =>
	create(`${PUBLIC_API_URL}/register`, {
		name,
		email,
		password,
		password_confirmation: passwordConfirmation
	});

export const logout = () => create(`${PUBLIC_API_URL}/logout`);

export const login = (email: string, password: string) =>
	create(`${PUBLIC_API_URL}/login`, {
		email,
		password
	});
