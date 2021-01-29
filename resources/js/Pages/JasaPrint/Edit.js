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
import SelectInput from "@/Shared/SelectInput";

export default () => {
    const { jasaprint, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        jenis_print: jasaprint.jenis_print || '',
        harga_print: jasaprint.harga_print || '',
        jumlah_print: jasaprint.jumlah_print || '',
        tanggal_print: jasaprint.tanggal_print || '',
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
        Inertia.put(route('JasaPrint.update', jasaprint.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Print Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('JasaPrint.destroy', jasaprint.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Print Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('JasaPrint.restore', {'JasaPrint': jasaprint.id}))
            }
        })
    }

    return (
        <Layout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Jasa Print | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('JasaPrint.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Jasa Print
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {values.jenis_print}
                </h1>
                {jasaprint.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This data print has been deleted.
                    </TrashedMessage>
                )}
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <SelectInput
                                className="pr-6 pb-8 w-1/2"
                                label="Jenis Print"
                                name="jenis_print"
                                errors={errors.jenis_print}
                                value={values.jenis_print}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="Hitam Putih">Hitam Putih</option>
                                <option value="Warna">Warna</option>
                                <option value="Warna-full">Warna-full</option>
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Harga Print"
                                name="harga_print"
                                errors={errors.harga_print}
                                value={values.harga_print}
                                onChange={handleChange}
                                type="number"
                                min="0"
                            />
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Jumlah Print"
                                name="jumlah_print"
                                errors={errors.jumlah_print}
                                value={values.jumlah_print}
                                onChange={handleChange}
                                type="number"
                                min="0"
                            />
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Tanggal Print"
                                name="tanggal_print"
                                errors={errors.tanggal_print}
                                value={values.tanggal_print}
                                onChange={handleChange}
                                type="date"
                                min="0"
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!jasaprint.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
                            <InertiaLink
                                href={route('JasaPrint.index')}
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
