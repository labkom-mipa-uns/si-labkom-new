import React, { useState } from 'react';
import Helmet from 'react-helmet';
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import SelectInput from '@/Shared/SelectInput';
import TrashedMessage from '@/Shared/TrashedMessage';

export default () => {
    const { jadwal, dosen, matkul, prodi, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        id_dosen: jadwal.id_dosen || '',
        dosen: jadwal.dosen || '',
        id_matkul: jadwal.id_matkul || '',
        matkul: jadwal.matkul || '',
        id_prodi: jadwal.id_prodi || '',
        prodi: jadwal.prodi || '',
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
        // Inertia.put(route('Jadwal.update', jadwal.id), values).then(() =>
        //     setSending(false)
        // );
        Inertia.post(route('Jadwal.update', jadwal.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Jadwal Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // Inertia.delete(route('Jadwal.destroy', jadwal.id));
                Inertia.get(route('Jadwal.destroy', jadwal.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Jadwal Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // Inertia.put(route('Jadwal.restore', jadwal.id))
                Inertia.post(route('Jadwal.restore', jadwal.id))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Jadwal | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Jadwal.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Jadwal
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {values.dosen.nama_dosen}
                </h1>
                {jadwal.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This jadwal has been deleted.
                    </TrashedMessage>
                )}
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Dosen"
                                name="id_dosen"
                                errors={errors.id_dosen}
                                value={values.id_dosen}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {dosen.map(({id, nama_dosen}) => (
                                    <option key={id} value={id}>
                                        {nama_dosen}
                                    </option>
                                ))}
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Mata Kuliah"
                                name="id_matkul"
                                errors={errors.id_matkul}
                                value={values.id_matkul}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {matkul.map(({id, nama_matkul}) => (
                                    <option key={id} value={id}>
                                        {nama_matkul}
                                    </option>
                                ))}
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-full"
                                label="Program Studi"
                                name="id_prodi"
                                errors={errors.id_prodi}
                                value={values.id_prodi}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {prodi.map(({ id, nama_prodi }) => (
                                    <option key={id} value={id}>
                                        {nama_prodi}
                                    </option>
                                ))}
                            </SelectInput>
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!jadwal.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
                            <InertiaLink
                                href={route('Jadwal.index')}
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
