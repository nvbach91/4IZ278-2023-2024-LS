import { useRef, useState } from 'react';
import DangerButton from '@/Components/DangerButton';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';

export default function DeleteUserForm({ className = '' }) {
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInput = useRef();

    const {
        data,
        setData,
        delete: destroy,
        processing,
        reset,
        errors,
    } = useForm({
        password: '',
    });

    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true);
    };

    const deleteUser = (e) => {
        e.preventDefault();

        destroy(route('profile.destroy'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserDeletion(false);
        reset();
    };

    return (
        <section className={`space-y-6 ${className}`}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Smazat účet</h2>

                <p className="mt-1 text-sm text-gray-600">
                    Jakmile bude váš účet smazán, všechny jeho zdroje a data budou trvale odstraněny. Před smazáním
                    účtu si prosím stáhněte všechna data nebo informace, které chcete zachovat.
                </p>
            </header>

            <DangerButton onClick={confirmUserDeletion}>Smazat účet</DangerButton>

            <Modal show={confirmingUserDeletion} onClose={closeModal}>
                <form onSubmit={deleteUser} className="p-6">
                    <h2 className="text-lg font-medium text-gray-900">
                        Opravdu chcete smazat svůj účet?
                    </h2>

                    <p className="mt-1 text-sm text-gray-600">
                        Jakmile bude váš účet smazán, všechny jeho zdroje a data budou trvale odstraněny. Pro potvrzení, že chcete trvale smazat svůj účet, zadejte své heslo.
                    </p>

                    <div className="mt-6">
                        <InputLabel htmlFor="password" value="Heslo" className="sr-only" />

                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            ref={passwordInput}
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            className="mt-1 block w-3/4"
                            isFocused
                            placeholder="Heslo"
                        />

                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="mt-6 flex justify-end">
                        <SecondaryButton onClick={closeModal}>Zrušit</SecondaryButton>

                        <DangerButton className="ms-3" disabled={processing}>
                            Smazat účet
                        </DangerButton>
                    </div>
                </form>
            </Modal>
        </section>
    );
}
