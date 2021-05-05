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
    const { mahasiswa, prodi, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        nama_mahasiswa: mahasiswa.nama_mahasiswa || '',
        nim: mahasiswa.nim || '',
        jenis_kelamin: mahasiswa.jenis_kelamin || '',
        kelas: mahasiswa.kelas || '',
        id_prodi: mahasiswa.id_prodi || '',
        prodi: mahasiswa.prodi || '',
        angkatan: mahasiswa.angkatan || '',
        no_hp: mahasiswa.no_hp || '',
        email: mahasiswa.email || '',
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
        // Inertia.put(route('Mahasiswa.update', mahasiswa.id), values).then(() =>
        //     setSending(false)
        // );
        Inertia.post(route('Mahasiswa.update', mahasiswa.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Mahasiswa Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // Inertia.delete(route('Mahasiswa.destroy', mahasiswa.id));
                Inertia.get(route('Mahasiswa.destroy', mahasiswa.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Mahasiswa Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // Inertia.put(route('Mahasiswa.restore', mahasiswa.id))
                Inertia.post(route('Mahasiswa.restore', mahasiswa.id))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Mahasiswa | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Mahasiswa.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Mahasiswa
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {values.nama_mahasiswa}
                </h1>
                {mahasiswa.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This mahasiswa has been deleted.
                    </TrashedMessage>
                )}
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="NIM"
                                name="nim"
                                errors={errors.nim}
                                value={values.nim}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Nama Lengkap"
                                name="nama_mahasiswa"
                                errors={errors.nama_mahasiswa}
                                value={values.nama_mahasiswa}
                                onChange={handleChange}
                            />
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
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
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Tahun Angkatan"
                                name="angkatan"
                                type="text"
                                errors={errors.angkatan}
                                value={values.angkatan}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jenis Kelamin"
                                name="jenis_kelamin"
                                errors={errors.jenis_kelamin}
                                value={values.jenis_kelamin}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Kelas"
                                name="kelas"
                                type="text"
                                errors={errors.kelas}
                                value={values.kelas}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="No WhatsApp"
                                name="no_hp"
                                type="tel"
                                errors={errors.no_hp}
                                value={values.no_hp}
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
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!mahasiswa.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
                            <InertiaLink
                                href={route('Mahasiswa.index')}
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
