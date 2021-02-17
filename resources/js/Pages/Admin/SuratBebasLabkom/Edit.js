import React, { useState } from 'react';
import Helmet from 'react-helmet';
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import TrashedMessage from '@/Shared/TrashedMessage';

export default () => {
    const { surat, mahasiswa, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        id_mahasiswa: surat.id_mahasiswa || '',
        tanggal: surat.tanggal || '',
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
        Inertia.put(route('SuratBebasLabkom.update', surat.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Surat Bebas Labkom Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('SuratBebasLabkom.destroy', surat.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Surat Bebas Labkom Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('SuratBebasLabkom.restore', surat.id))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Surat Bebas Labkom | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('SuratBebasLabkom.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Surat Bebas Labkom
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {surat.mahasiswa.nama_mahasiswa}
                </h1>
                {surat.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This surat has been deleted.
                    </TrashedMessage>
                )}
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
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
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!surat.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
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
                                Simpan Data
                            </LoadingButton>
                        </div>
                    </form>
                </div>
            </div>
        </AdminLayout>
    );
};
