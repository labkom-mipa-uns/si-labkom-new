import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import FileInput from '@/Shared/FileInput';
import { toFormData } from '@/utils';

export default () => {
    const { errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: '0',
        photo: ''
    });

    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value;
        setValues(values => ({
            ...values,
            [key]: value
        }));
    }

    function handleFileChange(file) {
        setValues(values => ({
            ...values,
            photo: file
        }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('User.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | User | Tambah Data" />
                <div>
                    <h1 className="mb-8 font-bold text-3xl">
                        <InertiaLink
                            as='a'
                            href={route('User.index')}
                            className="text-indigo-600 hover:text-indigo-700"
                        >
                            User
                        </InertiaLink>
                        <span className="text-indigo-600 font-medium"> /</span> Tambah Data
                    </h1>
                </div>
                <div className="bg-white rounded shadow overflow-hidden max-w-3xl">
                    <form name="createForm" onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Nama"
                                name="name"
                                errors={errors.name}
                                value={values.name}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Email"
                                name="email"
                                type="email"
                                errors={errors.email}
                                value={values.email}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Password"
                                name="password"
                                type="password"
                                errors={errors.password}
                                value={values.password}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Confirm Password"
                                name="password_confirmation"
                                type="password"
                                errors={errors.password_confirmation}
                                value={values.password_confirmation}
                                onChange={handleChange}
                            />
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Role"
                                name="role"
                                errors={errors.role}
                                value={values.role}
                                onChange={handleChange}
                            >
                                <option value="0">Admin</option>
                            </SelectInput>
                            <FileInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Photo"
                                name="photo"
                                accept="image/*"
                                errors={errors.photo}
                                value={values.photo}
                                onChange={handleFileChange}
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <LoadingButton
                                loading={sending}
                                type="submit"
                                className="btn-indigo"
                            >
                                Tambah Data
                            </LoadingButton>
                        </div>
                    </form>
                </div>
            </div>
        </AdminLayout>
    );
};
