import React, { useState } from 'react';
import Helmet from 'react-helmet';
import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import DeleteButton from '@/Shared/DeleteButton';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import TrashedMessage from '@/Shared/TrashedMessage';
import SelectInput from "@/Shared/SelectInput";

export default () => {
    const { jasainstallasi, mahasiswa, software, errors } = usePage().props;
    const [sending, setSending] = useState(false);

    const [values, setValues] = useState({
        id_mahasiswa: jasainstallasi.id_mahasiswa || '',
        laptop: jasainstallasi.laptop || '',
        kelengkapan: jasainstallasi.kelengkapan || '',
        tanggal: jasainstallasi.tanggal || '',
        id_software: jasainstallasi.id_software || '',
        jenis: jasainstallasi.jenis || '',
        keterangan: jasainstallasi.keterangan || '',
        jam_ambil: jasainstallasi.jam_ambil || '',
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
        Inertia.put(route('JasaInstallasi.update', jasainstallasi.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Installasi Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('JasaInstallasi.destroy', jasainstallasi.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Installasi Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('JasaInstallasi.restore', {'Jasa Installasi': jasainstallasi.id}))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Jasa Installasi | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('JasaInstallasi.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Jasa Installasi
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {jasainstallasi.mahasiswa.nama_mahasiswa}
                </h1>
                {jasainstallasi.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This installasi has been deleted.
                    </TrashedMessage>
                )}
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Mahasiswa"
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
                                label="Laptop"
                                name="laptop"
                                type="text"
                                errors={errors.laptop}
                                value={values.laptop}
                                onChange={handleChange}
                            />
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
                                label="Jenis"
                                name="jenis"
                                errors={errors.jenis}
                                value={values.jenis}
                                onChange={handleChange}
                            >
                                <option></option>
                                <option value="install">Install Software</option>
                                <option value="service">Service Hardware</option>
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Software"
                                name="id_software"
                                errors={errors.id_software}
                                value={values.id_software}
                                onChange={handleChange}
                            >
                                <option value="-"></option>
                                {software.map(({ id, nama_software }) => (
                                    <option key={id} value={id}>
                                        {nama_software}
                                    </option>
                                ))}
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jam Ambil"
                                name="jam_ambil"
                                type="time"
                                errors={errors.jam_ambil}
                                value={values.jam_ambil}
                                onChange={handleChange}
                            />
                            <div className="pr-6 pb-8 w-full lg:w-1/2">
                                <label className="form-label" htmlFor="kelengkapan">
                                    {"Kelengkapan"}:
                                </label>
                                <textarea name="kelengkapan" id="kelengkapan"
                                          className={`form-input ${errors.length ? 'error' : ''}`}
                                          onChange={handleChange}
                                          autoComplete='off'
                                          value={values.kelengkapan}
                                >
                                </textarea>
                                {errors && <div className="form-error">{errors[0]}</div>}
                            </div>
                            <div className="pr-6 pb-8 w-full lg:w-1/2">
                                <label className="form-label" htmlFor="keterangan">
                                    {"Keterangan"}:
                                </label>
                                <textarea name="keterangan" id="keterangan"
                                          className={`form-input ${errors.length ? 'error' : ''}`}
                                          onChange={handleChange}
                                          autoComplete='off'
                                          value={values.keterangan}
                                >
                                </textarea>
                                {errors && <div className="form-error">{errors[0]}</div>}
                            </div>
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!jasainstallasi.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
                            <InertiaLink
                                href={route('JasaInstallasi.index')}
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
