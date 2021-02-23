import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';

export default () => {
    const { errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        nama_software: '',
        harga_software: '',
    });

    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value;
        setValues(values => ({
            ...values,
            [key]: value
        }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('Software.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Software | Tambah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Software.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Software
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium"> /</span> Tambah Data
                </h1>
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Nama Software"
                                name="nama_software"
                                errors={errors.nama_software}
                                value={values.nama_software}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Harga Software"
                                name="harga_software"
                                type="number"
                                min="0"
                                errors={errors.harga_software}
                                value={values.harga_software}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <InertiaLink
                                href={route('Software.index')}
                                className="text-indigo-600 hover:text-indigo-700 ml-auto mr-6"
                                as="a"
                            >
                                Kembali
                            </InertiaLink>
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
