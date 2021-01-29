import React, { useState } from 'react';
import Helmet from 'react-helmet';
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import TrashedMessage from '@/Shared/TrashedMessage';

export default () => {
    const { lab, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        nama_lab: lab.nama_lab || '',
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
        Inertia.put(route('Laboratorium.update', lab.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Laboratorium Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('Laboratorium.destroy', lab.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Laboratorium Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('Laboratorium.restore', {'Laboratorium': lab.id}))
            }
        })
    }

    return (
        <Layout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Laboratorium | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Laboratorium.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Laboratorium
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {values.nama_lab}
                </h1>
                {lab.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This laboratorium has been deleted.
                    </TrashedMessage>
                )}
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
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!lab.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
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
                                Simpan Data
                            </LoadingButton>
                        </div>
                    </form>
                </div>
            </div>
        </Layout>
    );
};
