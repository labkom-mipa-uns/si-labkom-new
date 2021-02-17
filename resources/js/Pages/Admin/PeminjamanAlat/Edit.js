import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';
import Swal from "sweetalert2";
import TrashedMessage from "@/Shared/TrashedMessage";
import DeleteButton from "@/Shared/DeleteButton";

export default () => {
    const { peminjamanalat, mahasiswa, alat, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: peminjamanalat.id_mahasiswa || '',
        id_alat: peminjamanalat.id_alat || '',
        tanggal_pinjam: peminjamanalat.tanggal_pinjam || '',
        tanggal_kembali: peminjamanalat.tanggal_kembali || '',
        jam_pinjam: peminjamanalat.jam_pinjam || '',
        jam_kembali: peminjamanalat.jam_kembali || '',
        jumlah_pinjam: peminjamanalat.jumlah_pinjam || '',
        keperluan: peminjamanalat.keperluan || '',
        status: peminjamanalat.status || '',
        deleted_at: peminjamanalat.deleted_at || ''
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
        Inertia.put(route('PeminjamanAlat.update', peminjamanalat.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Peminjam Alat Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('PeminjamanAlat.destroy', peminjamanalat.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Peminjam Alat Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('PeminjamanAlat.restore', peminjamanalat.id))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Peminjaman Alat | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('PeminjamanLab.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Peminjaman Alat
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {peminjamanalat.mahasiswa.nama_mahasiswa}
                </h1>
                {peminjamanalat.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This peminjam alat has been deleted.
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
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Alat"
                                name="id_alat"
                                errors={errors.id_alat}
                                value={values.id_alat}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {alat.map(({ id, nama_alat }) => (
                                    <option key={id} value={id}>
                                        {nama_alat}
                                    </option>
                                ))}
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Tanggal Pinjam"
                                name="tanggal_pinjam"
                                type="date"
                                errors={errors.tanggal_pinjam}
                                value={values.tanggal_pinjam}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Tanggal Kembali"
                                name="tanggal_kembali"
                                type="date"
                                errors={errors.tanggal_kembali}
                                value={values.tanggal_kembali}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jam Pinjam"
                                name="jam_pinjam"
                                type="time"
                                errors={errors.jam_pinjam}
                                value={values.jam_pinjam}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jam Kembali"
                                name="jam_kembali"
                                type="time"
                                errors={errors.jam_kembali}
                                value={values.jam_kembali}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jumlah Pinjam"
                                name="jumlah_pinjam"
                                errors={errors.jumlah_pinjam}
                                value={values.jumlah_pinjam}
                                onChange={handleChange}
                                type="number"
                                min="0"
                            />
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Status"
                                name="status"
                                errors={errors.status}
                                value={values.status}
                                onChange={handleChange}
                            >
                                <option></option>
                                <option value="0">Masih Dipinjam</option>
                                <option value="1">Sudah Dikembalikan</option>
                            </SelectInput>
                            <div className="pr-6 pb-8 w-full lg:w-full">
                                <label className="form-label" htmlFor="keperluan">
                                    {"Keperluan"}:
                                </label>
                                <textarea name="keperluan" id="keperluan"
                                          className={`form-input ${errors.length ? 'error' : ''}`}
                                          onChange={handleChange}
                                          autoComplete='off'
                                >
                                    {values.keperluan}
                                </textarea>
                                {errors && <div className="form-error">{errors[0]}</div>}
                            </div>
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                            {!peminjamanalat.deleted_at && (
                                <DeleteButton onDelete={destroy}>Hapus</DeleteButton>
                            )}
                            <InertiaLink
                                href={route('PeminjamanLab.index')}
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
