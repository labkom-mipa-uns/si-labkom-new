import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';

export default () => {
    const { errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        nama_lab: '',
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
        Inertia.post(route('Laboratorium.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <Layout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Laboratorium | Tambah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Laboratorium.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Laboratorium
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium"> /</span> Tambah Data
                </h1>
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-full"
                                label="Nama Laboratorium"
                                name="nama_lab"
                                errors={errors.nama_lab}
                                value={values.nama_lab}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <InertiaLink
                                href={route('Laboratorium.index')}
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
        </Layout>
    );
};
