import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';

const Create = () => {
    const { mahasiswa, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: '',
        tanggal: '',
        proses: ''
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
        Inertia.post(route('SuratBebasLabkom.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <React.Fragment>
            <h1 className="mb-8 font-bold text-3xl">
                <InertiaLink
                    href={route('SuratBebasLabkom.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                    as="a"
                >
                    SuratBebasLabkom
                </InertiaLink>
                <span className="text-indigo-600 font-medium"> /</span> Tambah Data
            </h1>
            <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                <form onSubmit={handleSubmit}>
                    <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <SelectInput
                            className="pr-6 pb-8 w-full"
                            label="Nama Mahasiswa"
                            name="id_mahasiswa"
                            errors={errors.id_mahasiswa}
                            value={values.id_mahasiswa}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {mahasiswa.map(({ id, nama_mahasiswa }) => (
                                <option key={id} value={id}>
                                    {nama_mahasiswa}
                                </option>
                            ))}
                        </SelectInput>
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Tanggal"
                            name="tanggal"
                            type="date"
                            errors={errors.tanggal}
                            value={values.tanggal}
                            onChange={handleChange}
                        />
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Proses"
                            name="proses"
                            errors={errors.proses}
                            onChange={handleChange}
                            value={values.proses}
                        >
                            <option></option>
                            <option value="1">Menunggu Persetujuan</option>
                        </SelectInput>
                    </div>
                    <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                        <InertiaLink
                            href={route('SuratBebasLabkom.index')}
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
        </React.Fragment>
    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
Create.layout = page => <AdminLayout title="Labkom FMIPA UNS | Surat Bebas Labkom | Tambah Data" children={page} />;

export default Create;
