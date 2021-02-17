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
    const { peminjamanlab, mahasiswa, lab, jadwal, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: peminjamanlab.id_mahasiswa || '',
        id_lab: peminjamanlab.id_lab || '',
        id_jadwal: peminjamanlab.id_jadwal || '',
        tanggal: peminjamanlab.tanggal || '',
        jam_pinjam: peminjamanlab.jam_pinjam || '',
        jam_kembali: peminjamanlab.jam_kembali || '',
        keperluan: peminjamanlab.keperluan || '',
        kategori: peminjamanlab.kategori || '',
        status: peminjamanlab.status || ''
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
        Inertia.put(route('PeminjamanLab.update', peminjamanlab.id), values).then(() =>
            setSending(false)
        );
    }

    function destroy() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Peminjam Lab Akan Segera Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.delete(route('PeminjamanLab.destroy', peminjamanlab.id));
            }
        })
    }

    function restore() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data Peminjam Lab Akan Segera Dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Inertia.put(route('PeminjamanLab.restore', peminjamanlab.id))
            }
        })
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Peminjaman Lab | Ubah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('PeminjamanLab.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Peminjaman Lab
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium mx-2">/</span>
                    {peminjamanlab.mahasiswa.nama_mahasiswa}
                </h1>
                {peminjamanlab.deleted_at && (
                    <TrashedMessage onRestore={restore}>
                        This peminjam lab has been deleted.
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
                                label="Laboratorium"
                                name="id_lab"
                                errors={errors.id_lab}
                                value={values.id_lab}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {lab.map(({ id, nama_lab }) => (
                                    <option key={id} value={id}>
                                        {nama_lab}
                                    </option>
                                ))}
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jadwal"
                                name="id_jadwal"
                                errors={errors.id_jadwal}
                                value={values.id_jadwal}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {jadwal.map(({ id, dosen, matakuliah, prodi }) => (
                                    <option key={id} value={id}>
                                        {dosen.nama_dosen} - {matakuliah.nama_matkul} - {prodi.nama_prodi}
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
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Kategori"
                                name="kategori"
                                errors={errors.kategori}
                                value={values.kategori}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="didalam_jam">Didalam Jam Kuliah</option>
                                <option value="diluar_jam">Diluar Jam Kuliah</option>
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Status"
                                name="status"
                                errors={errors.status}
                                value={values.status}
                                onChange={handleChange}
                            >
                                <option value=""></option>
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
                            {!peminjamanlab.deleted_at && (
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
